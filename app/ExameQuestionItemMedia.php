<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExameQuestionItemMedia extends Model
{
    protected $fillable = [
        'exame_question_item_id', 'media_url', 'media_type'
    ];

    /**
     * Question Item
     */
    public function exame_question_item()
    {
        return $this->belongsTo('App\ExameQuestionItemMedia', 'exame_question_item_id');
    }
}
