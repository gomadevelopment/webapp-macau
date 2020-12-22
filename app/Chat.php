<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'is_group', 'user_1_id', 'user_2_id'
    ];

    /**
     * Users
     */
    public function user_1()
    {
        return $this->belongsTo('App\User', 'user_1_id');
    }

    /**
     * Users
     */
    public function user_2()
    {
        return $this->belongsTo('App\User', 'user_2_id');
    }

    /**
     * Chat User
     */
    public function chat_user()
    {
        return $this->hasMany('App\ChatUser', 'chat_id');
    }

    /**
     * Chat Users pivot
     */
    public function users() {
        return $this->belongsToMany(
            'App\User', 
            'chats_users', 
            'chat_id', 
            'user_id'
        );
    }

    /**
     * Chat messages - take last X messages
     */
    public function messages()
    {
        $all_messages_count = $this->hasMany('App\ChatMessage', 'chat_id')->count();
        return $this->hasMany('App\ChatMessage', 'chat_id')->skip($all_messages_count-30)->take(30);
    }

    /**
     * Individual Chat exists?
     */
    public static function chatExists($user_1_id, $user_2_id)
    {
        $chatExists = false;

        if(self::where('user_1_id', $user_1_id)->where('user_2_id', $user_2_id)->first()){
            $chatExists = self::where('user_1_id', $user_1_id)->where('user_2_id', $user_2_id)->first();
        }
        else if(self::where('user_2_id', $user_1_id)->where('user_1_id', $user_2_id)->first()){
            $chatExists = self::where('user_2_id', $user_1_id)->where('user_1_id', $user_2_id)->first();
        }

        return $chatExists;
    }

    // Create new individual chat
    public static function createNewChat($user_id)
    {
        $new_chat = self::create([
            'is_group' => 0,
            'user_1_id' => auth()->user()->id,
            'user_2_id' => $user_id
        ]);
        
        // Chat User admin (creator)
        ChatUser::create([
            'user_id' => $new_chat->user_1_id,
            'chat_id' => $new_chat->id,
            'is_admin' => 1
        ]);
        // Chat User non-admin (receiver)
        ChatUser::create([
            'user_id' => $new_chat->user_2_id,
            'chat_id' => $new_chat->id,
            'is_admin' => 0
        ]);

        Notification::create([
            'title' => 'Novo Chat Individual',
            'text' => 'Você criou um novo chat individual com, "'.$new_chat->user_2->username.'".',
            'url' => '/chat/' . $new_chat->user_2->id,
            'param1_text' => 'chat_with_user_id',
            'param1' => $new_chat->user_2->id,
            'param2_text' => '',
            'param2' => '',
            'type_id' => 3,
            'user_id' => $new_chat->user_1->id,
            'active' => 1
        ]);

        Notification::create([
            'title' => 'Novo Chat Individual',
            'text' => 'O utilizador "'.$new_chat->user_1->username.'" criou um chat indiviual consigo.',
            'url' => '/chat/' . $new_chat->user_1->id,
            'param1_text' => 'chat_with_user_id',
            'param1' => $new_chat->user_1->id,
            'param2_text' => '',
            'param2' => '',
            'type_id' => 3,
            'user_id' => $new_chat->user_2->id,
            'active' => 1
        ]);

        return $new_chat;
    }

    /**
     * Group Chat exists?
     */
    public static function groupChatExists($array_user_ids)
    {
        $chatExists = false;
        $all_group_chats = self::where('is_group', 1)->get();
        
        $array_user_ids = array_map(function($value) { return (int)$value; }, $array_user_ids);
        array_push($array_user_ids, auth()->user()->id);

        $checkIdsArray = [];
        foreach($all_group_chats as $group_chat){
            foreach($group_chat->users as $user){
                if(in_array($user->id, $array_user_ids)){
                    $checkIdsArray[] = $user->id;
                }
                else{
                    $checkIdsArray = [];
                    break;
                }
            }
            if($checkIdsArray === array_intersect($checkIdsArray, $array_user_ids) && $array_user_ids === array_intersect($array_user_ids, $checkIdsArray)){
                $chatExists = $group_chat;
                break;
            }
        }

        return $chatExists;
    }

    // Create new group chat
    public static function createNewGroupChat($array_user_ids)
    {
        $new_chat = self::create([
            'is_group' => 1,
            'user_1_id' => auth()->user()->id,
            'user_2_id' => null
        ]);

        // Chat User admin (creator)
        ChatUser::create([
            'user_id' => auth()->user()->id,
            'chat_id' => $new_chat->id,
            'is_admin' => 1
        ]);

        Notification::create([
            'title' => 'Novo Chat de Grupo',
            'text' => 'Você criou um novo chat de grupo.',
            'url' => '/chat_de_grupo/' . $new_chat->id,
            'param1_text' => 'group_chat_id',
            'param1' => $new_chat->id,
            'param2_text' => '',
            'param2' => '',
            'type_id' => 3,
            'user_id' => $new_chat->user_1->id,
            'active' => 1
        ]);
        
        foreach($array_user_ids as $user_id){
            ChatUser::create([
                'user_id' => $user_id,
                'chat_id' => $new_chat->id,
                'is_admin' => 0
            ]);

            Notification::create([
                'title' => 'Novo Chat de Grupo',
                'text' => 'O utilizador "'.$new_chat->user_1->username.'" criou um novo chat de grupo onde você foi incluído.',
                'url' => '/chat_de_grupo/' . $new_chat->id,
                'param1_text' => 'group_chat_id',
                'param1' => $new_chat->id,
                'param2_text' => '',
                'param2' => '',
                'type_id' => 3,
                'user_id' => $user_id,
                'active' => 1
            ]);
        }

        return $new_chat;
    }

    // Returns all group chats that the current user is in
    public static function getUserGroupChats($search_username = null)
    {
        $group_chat_ids = [];

        foreach (auth()->user()->chat_users as $chat_user) {
            if($chat_user->chat->is_group){
                $group_chat_ids[] = $chat_user->chat->id;
            }
        }
        
        if($search_username){
            return self::whereIn('id', $group_chat_ids)
                        ->whereHas('chat_user', function($q) use ($search_username){
                            return $q->whereHas('user', function($q2) use ($search_username){
                                return $q2->where('username', 'LIKE', '%' . $search_username . '%');
                            });
                        })
                        ->get();
        }
        else{
            return self::find($group_chat_ids);
        }
    }

    public static function saveMessage($data)
    {
        ChatMessage::create([
            'chat_id' => $data['chat_id'],
            'user_id' => $data['user_sender_id'],
            'message' => $data['message'],
            'order' => 0
        ]);

        $chat = self::find($data['chat_id']);

        if($chat->is_group){
            foreach($chat->users as $user){
                if($user->id == auth()->user()->id){
                    continue;
                }
                Notification::create([
                    'title' => 'Nova Mensagem em Chat de Grupo',
                    'text' => 'O utilizador "'.User::find($data['user_sender_id'])->username.'" enviou uma nova mensagem no chat de grupo.',
                    'url' => '/chat_de_grupo/' . $chat->id,
                    'param1_text' => 'group_chat_id',
                    'param1' => $chat->id,
                    'param2_text' => '',
                    'param2' => '',
                    'type_id' => 3,
                    'user_id' => $user->id,
                    'active' => 1
                ]);
            }
        }
        else{
            Notification::create([
                'title' => 'Nova Mensagem em Chat Individual',
                'text' => 'O utilizador "'.User::find($data['user_sender_id'])->username.'" enviou-lhe uma nova mensagem no chat.',
                'url' => $chat->user_1_id == $data['user_sender_id'] ? '/chat/' . $chat->user_1_id : '/chat/' . $chat->user_2_id,
                'param1_text' => 'chat_with_user_id',
                'param1' => $chat->user_1_id == $data['user_sender_id'] ? $chat->user_2_id : $chat->user_1_id,
                'param2_text' => '',
                'param2' => '',
                'type_id' => 3,
                'user_id' => $chat->user_1_id == $data['user_sender_id'] ? $chat->user_2_id : $chat->user_1_id,
                'active' => 1
            ]);
        }
    }
}
