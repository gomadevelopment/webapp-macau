<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ResetPasswordRequest;

use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function forgotPassword()
    {
        $credentials = request()->only('email');
        
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            request()->session()->flash('recover_password_error', 'O e-mail que inseriu não existe. Por favor, tente de novo..');
            return redirect('/')
                    ->with('recover_password_error', 'O e-mail que inseriu não existe. Por favor, tente de novo.')
                    ->withErrors(['recover_password_email_non_existent' => 'O e-mail que inseriu não existe. Por favor, tente de novo.'])
                    ->withInput();
        }

        try {
            Password::sendResetLink($credentials);
        } catch (\Exception $e) {
            request()->session()->flash('recover_password_error', 'Ocorreu um erro ao recuperar a palavra-passe. Por favor, tente de novo.');
            return redirect('/')
                    ->with('recover_password_error', 'Ocorreu um erro ao recuperar a palavra-passe. Por favor, tente de novo.')
                    ->withErrors(['recover_password_email_non_existent' => 'Ocorreu um erro ao recuperar a palavra-passe. Por favor, tente de novo.'])
                    ->withInput();
        }

        request()->session()->flash('success', 'Sucesso! Foi-lhe enviado um e-mail com a hiperligação de recuperação da palavra-passe para o seu e-mail de registo!');
        return redirect()->to('/');
    }

    public function resetPasswordGet($token = null)
    {
        $credentials = request()->only('email');
        $email = $credentials['email'];
        return view('layouts.new_password', compact('email', 'token'));
    }

    public function resetPasswordPost(ResetPasswordRequest $request)
    {
        try {
            $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            });

            if ($reset_password_status == Password::INVALID_TOKEN) {
                request()->session()->flash('new_password_error', 'A sua hiperligação de recuperação de e-mail expirou. Por favor, tente de novo');
                return redirect('/')
                        ->with('new_password_error', 'A sua hiperligação de recuperação de e-mail expirou. Por favor, tente de novo')
                        ->withInput();
            }
        } catch (\Exception $e) {
            request()->session()->flash('new_password_error', 'Ocorreu um erro ao atualizar a sua palavra-passe. Por favor, recupere a palavra-passe de novo');
            return redirect('/')
                    ->with('new_password_error', 'Ocorreu um erro ao atualizar a sua palavra-passe. Por favor, recupere a palavra-passe de novo')
                    ->withInput();
        }

        request()->session()->flash('success', 'A sua palavra-passe foi atualizada com sucesso! Já pode entrar na plataforma com a sua nova palavra-passe!');
        return redirect()->to('/');
    }
}
