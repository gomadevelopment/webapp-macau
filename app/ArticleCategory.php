<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = ['name'];
    
    /**
     * Articles
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    /**
     * Article Category Can be deleted
     */
    public function canBeDeleted()
    {
        if($this->articles->count()){
            return false;
        }
        else{
            return true;
        }
    }
}
