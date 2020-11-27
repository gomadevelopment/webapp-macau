<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleMedia extends Model
{
    protected $table = 'article_media';

    protected $fillable = [
        'article_id', 'media_url', 'media_type', 'poster'
    ];   
}
