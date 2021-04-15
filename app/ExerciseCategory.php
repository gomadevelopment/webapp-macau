<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseCategory extends Model
{
    protected $fillable = ['name'];
    
    /**
     * Exercises
     */
    public function exercises()
    {
        return $this->hasMany('App\Exercise');
    }

    /**
     * Exercise Category Can be deleted
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
