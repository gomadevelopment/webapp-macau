<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExameInquiry extends Model
{
    protected $table = 'exame_inquiries';

    protected $fillable = [
        'exame_id', 'inquirie_id', 'student_id', 'value'
    ];

    public function exame()
    {
        return $this->belongsTo('App\Exame', 'exame_id');
    }

    public function inquirie()
    {
        return $this->belongsTo('App\Inquiry', 'inquirie_id');
    }

    public function student()
    {
        return $this->belongsTo('App\User', 'student_id');
    }
}
