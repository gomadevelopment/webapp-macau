<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionItemMedia extends Model
{
    protected $fillable = [
        'question_item_id', 'media_url', 'media_type'
    ];

    /**
     * Question Item
     */
    public function question_item()
    {
        return $this->belongsTo('App\QuestionItemMedia', 'question_item_id');
    }
}
