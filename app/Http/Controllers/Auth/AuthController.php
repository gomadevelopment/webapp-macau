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
        return view('login');
    }   

    public function loginPost()
    {
        $inputs = $this->request->only('email', 'password');
        $validator = \Validator::make($inputs, [
            'email' => 'required',
            'password' => 'required',
        ], ['email.required' => 'Por favor insira o seu e-mail.', 
            'password.required' => 'Por favor insira a sua password.']);

        if ($validator->fails()) {
            // session()->flash('');
            return redirect('/')
                    ->with('login_error', 'Login Failed!')
                    ->withErrors($validator)
                    ->withInput();
        }

        if (!$user = auth()->attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) {
            return redirect('/')
                    ->with('login_error', 'Login Failed!')
                    ->withErrors(['login_incorrect' => 'Nome de Utilizador ou Password inválidos.'])
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