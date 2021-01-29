<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionItem extends Model
{
    protected $fillable = [
        'question_id', 'text_1', 'text_2', 'category', 'options_correct', 
        'options_1', 'options_2', 'options_3', 'options_4', 'options_5',
        'options_6', 'options_7', 'options_8', 'options_9', 'options_10'
    ];

    /**
     * Question
     */
    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    /**
     * Question Item
     */
    public function question_item_media()
    {
        return $this->hasOne('App\QuestionItemMedia', 'question_item_id');
    }

}
