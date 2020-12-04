<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'chat_id', 'user_id', 'message', 'order'
    ];

    /**
     * Chat
     */
    public function chat()
    {
        return $this->belongsTo('App\Chat', 'chat_id');
    }

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
