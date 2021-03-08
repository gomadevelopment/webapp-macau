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
     * Classes
     */
    public function classes()
    {
        return $this->hasMany('App\StudentClass', 'teacher_id');
    }

    /**
     * Unread Notifications
     */
    public function unread_notifications()
    {
        return $this->hasMany('App\Notification', 'user_id')->where('active', 1)->orderBy('created_at', 'DESC');
    }

    /**
     * Read Notifications
     */
    public function read_notifications()
    {
        return $this->hasMany('App\Notification', 'user_id')->where('active', 0)->orderBy('created_at', 'DESC');
    }

    public function getUnreadNotifications($limit = 10)
    {
        return $this->unread_notifications()->take($limit);
    }

    public function getReadNotifications($limit = 10)
    {
        return $this->read_notifications()->take($limit);
    }

    /**
     * Student Class
     */
    public function student_class_user()
    {
        return $this->hasOne('App\StudentClassUser', 'user_id');
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
     * Returns all users that present user has NOT a chat created with
     */
    public static function usersWithOutClass()
    {
        $all_users_with_class_ids = StudentClassUser::get()->pluck('user_id')->toArray();
        array_unique($all_users_with_class_ids);

        return self::whereNotIn('id', $all_users_with_class_ids)->where('user_role_id', 3)->get();
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
     * Get Student Colleagues
     */
    public function getStudentColleagues($class_id)
    {
        $students_ids = [];
        $students_ids = StudentClass::find($class_id)->students->pluck('id')->toArray();
        if(($key = array_search(auth()->user()->id, $students_ids)) !== false) {
            unset($students_ids[$key]);
        }

        return User::whereIn('id', $students_ids)->get();
    }

    /**
     * Get Professor Students by class
     */
    public function getProfessorStudents($class_id = null)
    {
        $students_ids = [];
        if(!$class_id){
            foreach($this->classes as $class){
                $students_ids = array_merge($students_ids, $class->students->pluck('id')->toArray());
            }
        }
        else{
            $students_ids = StudentClass::find($class_id)->students->pluck('id')->toArray();
        }

        return User::whereIn('id', $students_ids)->get();
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

    /**
     * Student has exercise in progress
     * returns an exame if the student has this exercise in progress
     * returns 'no_exame_started' if the student hasn't started this exercise
     * returns 'has_exame_finished' if the student has this exercise finished (none of the above)
     */
    public function hasExerciseInProgress($exercise_id)
    {
        $exercise = Exercise::find($exercise_id);
        $exame = Exame::where('student_id', $this->id)->where('exercise_id', $exercise->id)->first();

        if(!$exame){
            return 'no_exame_started';
        }

        if($exame->is_finished){
            return 'has_exame_finished';
        }

        if(!$exame->has_time){
            return $exame;
        }

        $start_timestamp_unix = strtotime($exame->start_timestamp);
        $exame_time_unix = $exame->time * 60;
        $exame_datetime_limit = gmdate("Y-m-d H:i:s", $start_timestamp_unix + $exame_time_unix);
        
        // Has exame in progress
        if(strtotime('now') < strtotime($exame_datetime_limit)){
            return $exame;
        }
        // Has exame finished
        else{
            return 'has_exame_finished';
        }
        
    }

    /**
     * Get All Student Exames for Professor Classroom
     */
    public function student_exames()
    {
        return $this->hasMany('App\Exame', 'student_id');
    }
}
