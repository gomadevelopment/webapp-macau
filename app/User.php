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
        'fullname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation Rules for user add
     *
     * @var array
     */
    public static $rulesForAdd = array(
        'fullname' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed'
    );

    public static function rulesForEdit($id = 0, $merge = [])
    {
        return array_merge([
            'fullname' => 'required',
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
        'name.required' => 'O nome é de preenchimento obrigatório.',
        'email.required' => 'O email é de preenchimento obrigatório.',
        'email.unique' => 'O email escolhido já existe nos nossos registos.',
        'password.required' => 'A password é de preenchimento obrigatório.',
        'password.min' => 'A password tem de no minímo 6 caracteres.',
        'password.confirmed' => 'As passwords inseridas não são iguais.',
    );
}
