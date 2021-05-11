<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        request()->session()->flash('error', 'Só pode aceder à página desejada depois de entrar na plataforma.');
        return redirect('/')
                ->with('error', 'Só pode aceder à página desejada depois de entrar na plataforma.')
                ->withInput();
    }

    public function verify(Request $request)
    {
        $user = User::find($request->id);
        // dd($user);
        if ($request->route('id') != $user->getKey()) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->to('/')
                ->with('success', 'O seu e-mail já está confirmado. Já pode entrar na plataforma!');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->to('/')
                ->with('success', 'E-mail confirmado com sucesso. Já pode entrar na plataforma!')
                ->with('verified', true);
    }

    public function resend($user_id)
    {
        $user = User::find($user_id);
        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath())
                ->with('success', 'O seu e-mail já está confirmado. Já pode entrar na plataforma!');
        }

        $user->sendEmailVerificationNotification();

        return redirect('/')
                ->with('success', 'E-mail de confirmação re-enviado com sucesso.')
                ->with('resent', true);
    }
}
