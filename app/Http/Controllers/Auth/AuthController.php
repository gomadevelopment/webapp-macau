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
            request()->session()->flash('login_error', 'Nome de Utilizador ou password inválidos.');
            return redirect('/')
                    ->with('login_error', 'Nome de Utilizador ou password inválidos.')
                    ->withErrors(['login_incorrect' => 'Nome de Utilizador ou password inválidos.'])
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