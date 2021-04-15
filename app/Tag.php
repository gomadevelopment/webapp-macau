<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];  

    /**
     * Article Tags
     */
    public function article_tags() { 
        return $this->belongsToMany(
            'App\Article', 
            'articles_tags', 
        );
    }

    /**
     * Exercise Tags
     */
    public function exercise_tags() {
        return $this->belongsToMany(
            'App\Tag', 
            'exercises_tags', 
        );
    }

    /**
     * Tag Can be deleted
     */
    public function canBeDeleted()
    {
        if($this->article_tags->count() || $this->exercise_tags->count()){
            return false;
        }
        else{
            return true;
        }
    }
}
