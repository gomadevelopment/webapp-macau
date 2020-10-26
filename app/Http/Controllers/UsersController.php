<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    
    public function signUp()
    {
        $inputs = request()->all();

        $validator = \Validator::make($inputs, User::$rulesForAdd, User::$messages);

        if ($validator->fails()) {
            request()->session()->flash('error', 'Por favor verifique os erros no formulário.');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('signup_error', 'SignUp Failed!');
        }

        $new_user = User::create([
            'fullname' => $inputs["fullname"],
            'email' => $inputs["email"],
            'password' => bcrypt($inputs["password"]),
        ]);

        return redirect()->to('/');
    }

    public function signIn()
    {
        
    }
}
