<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExameQuestion extends Model
{
    protected $fillable = [
        'exame_id', 'classification', 'title', 'section', 'question_type_id', 'question_subtype_id', 
        'reference', 'description', 'description_image_url', 'teacher_correction', 'avaliation_score'
    ];

    /**
     * Exercise
     */
    public function exame()
    {
        return $this->belongsTo('App\Exercise', 'exame_id');
    }

    /**
     * Question Items
     */
    public function question_items()
    {
        return $this->hasMany('App\ExameQuestionItem');
    }

    /**
     * Question Type
     */
    public function question_type()
    {
        return $this->belongsTo('App\QuestionType', 'question_type_id');
    }

    /**
     * Question SubType
     */
    public function question_subtype()
    {
        return $this->belongsTo('App\QuestionSubType', 'question_subtype_id');
    }
}
