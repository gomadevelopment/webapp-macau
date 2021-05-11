<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User, App\Sst;

class AuthController extends Controller
{
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth', ['except' => ['login', 'loginPost']]);
        $this->request = $request;
    }

    public function login()
    {
        request()->session()->flash('error', 'Só pode aceder à página desejada depois de entrar na plataforma.');
        return redirect('/')
            ->with('error', 'Só pode aceder à página desejada depois de entrar na plataforma.')
            ->withInput();
    }

    public function loginPost()
    {
        $inputs = $this->request->only('username', 'password');

        $validator = \Validator::make($inputs, [
            'username' => 'required',
            'password' => 'required',
        ], ['username.required' => 'Por favor, insira o seu nome de utilizador.', 
            'password.required' => 'Por favor, insira a sua password.']);

        if ($validator->fails()) {
            request()->session()->flash('login_error', 'Por favor, verifique os erros no formulário.');
            return redirect('/')
                    ->with('login_error', 'Por favor, verifique os erros no formulário.')
                    ->withErrors($validator)
                    ->withInput();
        }

        if (!$user = auth()->attempt(['username' => $inputs['username'], 'password' => $inputs['password']])) {
            $login_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'Nome de Utilizador ou password inválidos.' 
                                : 'Username or password is invalid.';
            request()->session()->flash('login_error', $login_error);
            return redirect('/')
                    ->with('login_error', $login_error)
                    ->withErrors(['login_incorrect' => $login_error])
                    ->withInput();
        }

        if(!auth()->user()->hasVerifiedEmail()){
            request()->session()->flash('not_yet_verified', 'Ainda não confirmou o seu e-mail.');
            $user_id = auth()->user()->id;
            session()->flush();
            auth()->logout();
            return redirect('/')
                    ->with('not_yet_verified', 'Ainda não confirmou o seu e-mail.')
                    ->with('user_id', $user_id)
                    ->withInput();
        }

        if (!auth()->user()->isActive()) {
            $login_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'Este utilizador está desativado. Por favor, contacte o suporte.' 
                                : 'This user is deactivated. Please, contact the support.';
            request()->session()->flash('login_error', $login_error);
            session()->flush();
            auth()->logout();
            return redirect('/')
                    ->with('login_error', $login_error)
                    ->withErrors(['login_incorrect' => $login_error])
                    ->withInput();
        }

        return redirect()->to('/');
    }    

    public function logout()
    {
        session()->flush();

        auth()->logout();

        return redirect()->to('/');
    }   

    public function forbidden()
    {
        return view('forbidden');       
    }  

    public function expired()
    {
        return view('expired');       
    }

}