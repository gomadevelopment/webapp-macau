<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseFavorite extends Model
{
    protected $table = 'exercise_favourites';

    protected $fillable = [
        'exercise_id', 'user_id'
    ];  
}
