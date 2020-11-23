<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'user_role_id', 'avatar_url', 'first_name',
        'last_name', 'second_email', 'linkedin_url', 'university_id', 'resume', 'student_number', 'show_email',
        'show_performance', 'active'
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
            'second_email' => ['required', 'email', Rule::unique('users')->ignore($id)],
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
        'second_email.unique' => 'O e-mail secundário introduzido já existe.',
        'password.required' => 'A password é de preenchimento obrigatório.',
        'password.min' => 'A password tem de ter no mínimo 6 caracteres.',
        'password.confirmed' => 'As passwords inseridas não são iguais.',
    );

    /**
     * Role
     */
    public function role()
    {
        return $this->belongsTo('App\UserRole', 'user_role_id');
    }

    /**
     * University
     */
    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }

    public function saveEditProfile($inputs)
    {
        $this->username = $inputs['username'];
        $this->first_name = $inputs['first_name'];
        $this->last_name = $inputs['last_name'];
        $this->email = $inputs['email'];
        $this->second_email = $inputs['second_email'];
        $this->password = bcrypt($inputs['password']);
        $this->linkedin_url = isset($inputs['linkedin_url']) ? $inputs['linkedin_url'] : null;
        $this->university_id = $inputs['select_university'] == 0 ? null : $inputs['select_university'];
        $this->student_number = isset($inputs['student_number']) ? $inputs['student_number'] : null;
        $this->resume = $inputs['resume'];
        $this->show_email = isset($inputs['show_email']) && $inputs['show_email'] == 'on' ? 1 : 0;
        $this->show_performance = isset($inputs['show_performance']) && $inputs['show_performance'] == 'on' ? 1 : 0;

        $this->save();

    }

    public function storeUserAvatar($inputs){

        $upload_date = date('Y-m-d_H:i:s_');
        $paths = [];

        Storage::disk('webapp-macau-storage')->deleteDirectory($this->id.'/avatar');

        $fileName = $upload_date . $inputs['avatar_url']->getClientOriginalName();

        $paths = $inputs['avatar_url']->storeAs('/'
            . $this->id.'/avatar', $fileName, 'webapp-macau-storage');

        $this->avatar_url = $fileName;
        $this->save();

        return $fileName;
    }
}
