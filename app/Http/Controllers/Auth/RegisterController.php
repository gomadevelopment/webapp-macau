<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data = [])
    {
        $inputs = request()->all();

        $validator = Validator::make($inputs, User::$rulesForAdd, User::$messages);

        if ($validator->fails()) {
            $signup_error = \Session::get('locale') == 'pt' || !\Session::has('locale') 
                                ? 'Por favor, verifique os erros no formulário.' 
                                : 'Please, check the errors in the form.';
            request()->session()->flash('signup_error', $signup_error);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('signup_error', $signup_error);
        }

        $new_user = User::create([
            'username' => $inputs["username"],
            'email' => $inputs["email"],
            'password' => bcrypt($inputs["password"]),
            'user_role_id' => $inputs["professor_or_student"] == 'professor' ? 4 : 3,
            'active' => 1
        ]);

        $new_user->sendEmailVerificationNotification();

        request()->session()->flash('success', 'Utilizador criado com sucesso! Para entrar, verifique o seu e-mail.');

        return redirect()->to('/');
    }
}
