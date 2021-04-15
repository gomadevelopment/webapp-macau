<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = ['name'];

    /**
     * Users
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * University Can be deleted
     */
    public function canBeDeleted()
    {
        if($this->users->count()){
            return false;
        }
        else{
            return true;
        }
    }
}
