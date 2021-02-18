<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExameQuestionItem extends Model
{
    protected $fillable = [
        'exame_question_id', 'text_1', 'text_2', 'category', 'options_correct', 'options_answered', 'options_number',
        'options_1', 'options_2', 'options_3', 'options_4', 'options_5',
        'options_6', 'options_7', 'options_8', 'options_9', 'options_10'
    ];

    /**
     * Question
     */
    public function question()
    {
        return $this->belongsTo('App\ExameQuestion', 'exame_question_id');
    }

    /**
     * Question Item
     */
    public function question_item_media()
    {
        return $this->hasOne('App\ExameQuestionItemMedia', 'exame_question_item_id');
    }
}
