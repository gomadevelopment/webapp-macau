<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBlocked extends Model
{
    protected $table = 'users_blocked';

    protected $fillable = [
        'user_id', 'user_blocked_id'
    ]; 

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * User Blocked
     */
    public function user_blocked()
    {
        return $this->belongsTo('App\User', 'user_blocked_id');
    }
}
