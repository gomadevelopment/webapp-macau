<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    /**
     * QuestionType SubTypes
     */
    public function subtypes()
    {
        return $this->hasMany('App\QuestionSubType');
    }
}
