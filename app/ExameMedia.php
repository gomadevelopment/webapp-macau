<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExameMedia extends Model
{
    protected $table = 'exame_media';

    protected $fillable = [
        'exame_id', 'media_url', 'media_type'
    ];
}
