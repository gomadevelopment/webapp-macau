<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Chat,
    App\ChatMessage,
    App\ChatUser,
    App\UserBlocked,
    App\User;

use DB;

class ChatController extends Controller
{
    public function getChat($user_id)
    {
        $chatExists = Chat::chatExists(auth()->user()->id, $user_id);

        try {

            if($chatExists){
                $chat = $chatExists;
            }
            else{
                $chat = Chat::createNewChat($user_id);
            }

        } catch (\Exception $e) {
            // dd($e);
            return redirect()
                ->back()
                ->withInput()
                ->with('chat_error', 'Ocorreu um erro ao carregar o chat com o desejado utilizador. Por favor, tente de novo!');
        }

        $users_with_chats = User::usersWithChat();
        $users_without_chats = User::where('id', '!=', auth()->user()->id)->get();

        $group_chats = Chat::getUserGroupChats();

        return view('users.chat', compact('chat', 'users_with_chats', 'users_without_chats', 'group_chats'));
    }

    public function getGroupChat()
    {
        $data = request()->only('group_chat_user_ids');
        $chatExists = Chat::groupChatExists($data['group_chat_user_ids']);

        try {

            if($chatExists){
                $chat = $chatExists;
            }
            else{
                $chat = Chat::createNewGroupChat($data['group_chat_user_ids']);
            }

        } catch (\Exception $e) {
            // dd($e);
            return response()->json([
                    'status' => 'error',
                    'message' => 'Ocorreu um erro ao carregar o chat de grupo. Por favor, tente de novo!'
                ]);
        }

        return response()->json([
                'status' => 'success',
                'chat_id' => $chat->id
            ]);
    }

    public function redirectToGroupChat($id)
    {
        $chat = Chat::find($id);

        $users_with_chats = User::usersWithChat();
        $users_without_chats = User::where('id', '!=', auth()->user()->id)->get();

        $group_chats = Chat::getUserGroupChats();

        return view('users.chat', compact('chat', 'users_with_chats', 'users_without_chats', 'group_chats'));
    }

    public function postChatMessage()
    {
        $data = request()->all();

        DB::beginTransaction();
        try{
            
            Chat::saveMessage($data);

        }catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return response()->json([
                    'status' => 'error',
                    'message' => 'Ocorreu um erro ao enviar a sua mensagem! Por favor, tente de novo.'
                ]);
        }
        DB::commit();

        return response()->json([
                'status' => 'success',
                'message' => 'A sua mensagem foi enviada com sucesso! Espere 30 segundos para o chat atualizar.'
            ]);
    }

    public function getChatMessages($chat_id)
    {
        $chat = Chat::find($chat_id);

        if(!$chat){
            request()->session()->flash('error', 'Ocorreu um erro ao atualizar as mensagens deste chat. Por favor, tente de novo!');
            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao atualizar as mensagens deste chat. Por favor, tente de novo!'], 200);
        }

        try{

            if($chat->is_group){
                $other_user = null;
            }
            else{
                if(auth()->user()->id == $chat->user_2->id){
                    $other_user = $chat->user_1;
                }
                else{
                    $other_user = $chat->user_2;
                }
            }

            $view = view()->make("users.chat-partials.chat-body", [
                'chat' => $chat,
                'other_user' => $other_user
            ]);
            $html = $view->render();
            
        }catch (\Exception $e) {
            // dd($e);
            request()->session()->flash('error', 'Ocorreu um erro ao atualizar as mensagens deste chat. Por favor, tente de novo!');
            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao atualizar as mensagens deste chat. Por favor, tente de novo!'], 200);    
        }

        return response()->json([
            'status' => 'success',
            'html' => $html
        ]);
    }

    public function searchUsers()
    {
        $data = request()->only('search_username', 'chat_id');

        $chat = Chat::find($data['chat_id']);

        $users_with_chats = User::usersWithChat($data['search_username']);
        $group_chats = Chat::getUserGroupChats($data['search_username']);

        if(!$chat){
            request()->session()->flash('error', 'Ocorreu um erro ao filtrar os utilizadores. Por favor, tente de novo!');
            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao filtrar os utilizadores. Por favor, tente de novo!'], 200);
        }

        if($chat->is_group){
            $other_user = null;
        }
        else{
            if(auth()->user()->id == $chat->user_2->id){
                $other_user = $chat->user_1;
            }
            else{
                $other_user = $chat->user_2;
            }
        }

        $view = view()->make("users.chat-partials.chat-users", [
            'chat' => $chat,
            'users_with_chats' => $users_with_chats,
            'group_chats' => $group_chats,
            'other_user' => $other_user
        ]);
        $html = $view->render();

        return response()->json([
            'status' => 'success',
            'html' => $html
        ]);
    }
}
