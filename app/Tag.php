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
     * Article Tags pivot
     */
    public function article_tags() { 
        return $this->belongsToMany(
            'App\Article', 
            'articles_tags', 
            'tag_id', 
            'article_id'
        );
    }
}
