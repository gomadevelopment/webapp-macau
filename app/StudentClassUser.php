<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClassUser extends Model
{
    protected $fillable = [
        'student_class_id', 'user_id'
    ];

    /**
     * StudentClass
     */
    public function student_class()
    {
        return $this->belongsTo('App\StudentClass', 'student_class_id');
    }

    /**
     * Chat User
     */
    public function users()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public static function insertStudent($data)
    {
        $students_ids = [];
        foreach($data['student_ids_for_class'] as $student_id){
            $students_ids[] = $student_id;
            self::create([
                'student_class_id' => $data['class_id'],
                'user_id' => $student_id
            ]);
        }

        return $students_ids;
    }
}
