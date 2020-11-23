<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User,
    App\University;

use DB;

class UsersController extends Controller
{
    
    public function signUp()
    {
        $inputs = request()->all();

        $validator = \Validator::make($inputs, User::$rulesForAdd, User::$messages);

        if ($validator->fails()) {
            request()->session()->flash('signup_error', 'Por favor, verifique os erros no formulário.');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('signup_error', 'Por favor, verifique os erros no formulário.');
        }

        $new_user = User::create([
            'username' => $inputs["username"],
            'email' => $inputs["email"],
            'password' => bcrypt($inputs["password"]),
            'user_role_id' => $inputs["professor_or_student"] == 'professor' ? 2 : 3
        ]);

        return redirect()->to('/');
    }

    public function index_profile($id)
    {
        $user = User::find($id);

        return view('users.index_profile', compact('user'));
    }

    public function edit_profile($id)
    {
        $user = User::find($id);
        $universities = University::get();

        return view('users.edit_profile', compact('user', 'universities'));
    }

    public function editPost_profile($id)
    {
        $inputs = request()->all();

        $password_rule = [];
        if(isset($inputs['password'])){
            $password_rule = ['password' => 'required|min:6|confirmed'];
        }
        
        $user = User::find($id);

        $validator = \Validator::make($inputs, User::rulesForEdit(auth()->user()->id, $password_rule), User::$messages);

        if ($validator->fails()) {
            request()->session()->flash('edit_profile_error', 'Por favor, verifique os erros no formulário.');
            request()->session()->flash('error', 'Ocorreu um erro ao atualizar o seu perfil. Por favor, tente de novo!');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('edit_profile_error', 'Por favor, verifique os erros no formulário.');
        }

        DB::beginTransaction();
        try {
            
            $user->saveEditProfile($inputs);

        } catch (\Exception $e) {

            DB::rollback();

            request()->session()->flash('edit_profile_error', 'Por favor, verifique os erros no formulário.');
            request()->session()->flash('error', 'Ocorreu um erro ao atualizar o seu perfil. Por favor, tente de novo!');
            return redirect()
                ->back()
                ->withInput()
                ->with('edit_profile_error', 'Por favor, verifique os erros no formulário.');
        }
        DB::commit();

        request()->session()->flash('success', 'Utilizador atualizado com sucesso!');

        $universities = University::get();

        return view('users.edit_profile', compact('user', 'universities'));
    }

    public function chat()
    {
        return view('users.chat');
    }

    public function replaceUserAvatar()
    {
        $data = request()->all();

        $user = User::find($data['user_id']);
        
        $inputs = [
            'avatar_url' => $data['new_user_avatar']
        ];

        DB::beginTransaction();
        try {
            
            $avatar_url = $user->storeUserAvatar($inputs);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro ao substituir a sua fotografia. Por favor, tente de novo!']);
        }
        DB::commit();
        
        return response()->json(['status' => 'success', 'avatar_url' => $avatar_url]);
    }
}
