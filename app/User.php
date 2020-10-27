<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Validation\Rule;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Validation Rules for user add
     *
     * @var array
     */
    public static $rulesForAdd = array(
        'username' => 'required|min:6|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed'
    );

    public static function rulesForEdit($id = 0, $merge = [])
    {
        return array_merge([
            'username' => ['required', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'password' => 'required|min:6|confirmed'
        ], $merge);
    }

    /**
     * Validation Messages for user add
     *
     * @var array
     */
    public static $messages = array(
        'username.required' => 'O nome é de preenchimento obrigatório.',
        'username.min' => 'O nome tem de ter no mínimo 6 caracteres.',
        'username.unique' => 'O nome de utilizador introduzido já existe.',
        'email.required' => 'O e-mail é de preenchimento obrigatório.',
        'email.unique' => 'O e-mail introduzido já existe.',
        'password.required' => 'A password é de preenchimento obrigatório.',
        'password.min' => 'A password tem de ter no mínimo 6 caracteres.',
        'password.confirmed' => 'As passwords inseridas não são iguais.',
    );
}
