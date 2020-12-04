<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    protected $table = 'chats_users';

    protected $fillable = [
        'user_id', 'chat_id', 'is_admin'
    ];

    /**
     * Chat
     */
    public function chat()
    {
        return $this->belongsTo('App\Chat', 'chat_id');
    }

    /**
     * Chat
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
