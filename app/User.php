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
            // 'second_email' => ['required', 'email', Rule::unique('users')->ignore($id)],
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

    /**
     * Articles
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'user_id');
    }

    /**
     * Chat User 1
     */
    public function chat_user_1()
    {
        return $this->hasMany('App\Chat', 'user_1_id');
    }

    /**
     * Chat User 2
     */
    public function chat_user_2()
    {
        return $this->hasMany('App\Chat', 'user_2_id');
    }

    /**
     * Chat User 2
     */
    public function chat_users()
    {
        return $this->hasMany('App\ChatUser', 'user_id');
    }

    /**
     * Returns all users that present user has a chat created with
     */
    public static function usersWithChat($search_username = null)
    {
        $users_with_chat_ids = [];
        foreach (auth()->user()->chat_users as $chat_user) {
            if(!$chat_user->chat->is_group){
                if($chat_user->chat->user_1_id == auth()->user()->id){
                    $users_with_chat_ids[] = $chat_user->chat->user_2_id;
                }
                else{
                    $users_with_chat_ids[] = $chat_user->chat->user_1_id;
                }
            }
        }
        
        if($search_username){
            return self::whereIn('id', $users_with_chat_ids)->where('username', 'LIKE', '%' . $search_username . '%')->get();
        }
        else{
            return self::find($users_with_chat_ids);
        }
    }

    /**
     * Returns all users that present user has NOT a chat created with
     */
    public static function usersWithOutChat()
    {
        $users_with_chat_ids = [];
        foreach (auth()->user()->chat_users as $chat_user) {
            if(!$chat_user->chat->is_group){
                if($chat_user->chat->user_1_id == auth()->user()->id){
                    $users_with_chat_ids[] = $chat_user->chat->user_2_id;
                }
                else{
                    $users_with_chat_ids[] = $chat_user->chat->user_1_id;
                }
            }
        }

        return self::whereNotIn('id', $users_with_chat_ids)->get();
    }

    /**
     * User Block
     */
    public function user_block()
    {
        return $this->hasMany('App\UserBlocked', 'user_id');
    }

    /**
     * User Blocked
     */
    public function user_blocked()
    {
        return $this->hasMany('App\UserBlocked', 'user_blocked_id');
    }

    /**
     * User is Blocked?
     */
    public function blockedUser($user_blocked_id)
    {
        $userBlocked = UserBlocked::where('user_id', $this->id)->where('user_blocked_id', $user_blocked_id)->first();
        if($userBlocked){
            return $userBlocked;
        }
        else{
            return false;
        }
    }

    /**
     * Either user is blocked
     */
    public function eitherUserBlocked($user_blocked_id)
    {
        $userBlocked1 = UserBlocked::where('user_id', $this->id)->where('user_blocked_id', $user_blocked_id)->first();
        $userBlocked2 = UserBlocked::where('user_blocked_id', $this->id)->where('user_id', $user_blocked_id)->first();
        if($userBlocked1 || $userBlocked2){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Article Favorites pivot
     */
    public function article_favorite() {
        return $this->belongsToMany(
            'App\Article', 
            'article_favorites', 
            'user_id', 
            'article_id'
        );
    }

    public function saveEditProfile($inputs)
    {
        $this->username = $inputs['username'];
        $this->first_name = $inputs['first_name'];
        $this->last_name = $inputs['last_name'];
        $this->email = $inputs['email'];
        $this->second_email = $inputs['second_email'];
        if(isset($inputs['password'])){
            $this->password = bcrypt($inputs['password']);
        }
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

        Storage::disk('webapp-macau-storage')->deleteDirectory('avatars/'.$this->id);

        $fileName = $upload_date . $inputs['avatar_url']->getClientOriginalName();

        $paths = $inputs['avatar_url']->storeAs('/avatars/'
            . $this->id, $fileName, 'webapp-macau-storage');

        $this->avatar_url = $fileName;
        $this->save();

        return $fileName;
    }
}
