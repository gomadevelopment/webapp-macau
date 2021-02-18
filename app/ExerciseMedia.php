<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseMedia extends Model
{
    protected $table = 'exercise_media';

    protected $fillable = [
        'exercise_id', 'media_url', 'media_type'
    ];
}
