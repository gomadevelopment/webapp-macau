<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    
    public function signUp()
    {
        $inputs = request()->all();
        // dd($inputs);
        $validator = \Validator::make($inputs, User::$rulesForAdd, User::$messages);

        if ($validator->fails()) {
            // dd($validator);
            request()->session()->flash('error', 'Por favor, verifique os erros no formulário.');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('signup_error', 'SignUp Failed!');
        }

        $new_user = User::create([
            'username' => $inputs["username"],
            'email' => $inputs["email"],
            'password' => bcrypt($inputs["password"]),
            'role' => $inputs["professor_or_student"] == 'professor' ? 2 : 3
        ]);

        return redirect()->to('/');
    }
}
