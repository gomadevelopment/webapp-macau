<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseTag extends Model
{
    protected $table = 'exercises_tags';

    protected $fillable = [
        'exercise_id', 'tag_id'
    ];  
}
