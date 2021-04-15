<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseLevel extends Model
{
    protected $table = 'exercise_level';

    protected $fillable = ['name'];

    /**
     * Exercises
     */
    public function exercises()
    {
        return $this->hasMany('App\Exercise');
    }

    /**
     * Exercise Level Can be deleted
     */
    public function canBeDeleted()
    {
        if($this->exercises->count()){
            return false;
        }
        else{
            return true;
        }
    }
}
