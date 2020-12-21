<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title', 'text', 'url', 'param1_text', 'param1', 'param2_text',
        'param2', 'type_id', 'user_id', 'active'
    ];

    /**
     * Notification Type
     */
    public function type()
    {
        return $this->belongsTo('App\NotificationType', 'type_id');
    }

    /**
     * Notification Type
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
