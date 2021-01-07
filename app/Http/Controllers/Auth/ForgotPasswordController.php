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
            $recover_password_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'O e-mail que inseriu não existe. Por favor, tente de novo.' 
                                : "The e-mail inserted doesn't exist. Please, try again.";
            request()->session()->flash('recover_password_error', $recover_password_error);
            return redirect('/')
                    ->with('recover_password_error', $recover_password_error)
                    ->withErrors(['recover_password_email_non_existent' => $recover_password_error])
                    ->withInput();
        }

        try {
            Password::sendResetLink($credentials);
        } catch (\Exception $e) {
            $recover_password_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'Ocorreu um erro ao recuperar a palavra-passe. Por favor, tente de novo.' 
                                : 'An error has occurred trying to recover your password. Please, try again.';
            request()->session()->flash('recover_password_error', $recover_password_error);
            return redirect('/')
                    ->with('recover_password_error', $recover_password_error)
                    ->withErrors(['recover_password_email_non_existent' => $recover_password_error])
                    ->withInput();
        }

        $success_message = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'Sucesso! Foi-lhe enviado um e-mail com a hiperligação de recuperação da palavra-passe para o seu e-mail de registo!' 
                                : 'Success! An e-mail was sent with the password recover link to your register e-mail.';
        request()->session()->flash('success', $success_message);
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
                $new_password_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                    ? 'A sua hiperligação de recuperação de e-mail expirou. Por favor, tente de novo.' 
                                    : 'Your recover password link has expired. Please, try again.';
                request()->session()->flash('new_password_error', $new_password_error);
                return redirect('/')
                        ->with('new_password_error', $new_password_error)
                        ->withInput();
            }
        } catch (\Exception $e) {
            $new_password_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'Ocorreu um erro ao atualizar a sua palavra-passe. Por favor, recupere-a de novo.' 
                                : 'An error has occurred updating your password. Please, recover it again.';
            request()->session()->flash('new_password_error', $new_password_error);
            return redirect('/')
                    ->with('new_password_error', $new_password_error)
                    ->withInput();
        }

        $success_message = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'A sua palavra-passe foi atualizada com sucesso! Já pode entrar na plataforma com a sua nova palavra-passe!' 
                                : 'Your password was updated successfully! You can now enter the platform with your new password!';
        request()->session()->flash('success', $success_message);
        return redirect()->to('/');
    }
}
