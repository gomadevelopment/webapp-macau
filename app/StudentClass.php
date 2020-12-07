<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $fillable = [
        'name', 'teacher_id'
    ];

    /**
     * Teacher
     */
    public function teacher()
    {
        return $this->belongsTo('App\User', 'teacher_id');
    }

    /**
     * Students
     */
    public function students() {
        return $this->belongsToMany(
            'App\User', 
            'student_class_users', 
            'student_class_id', 
            'user_id'
        );
    }

    public static function createClass($class_name)
    {
        if(self::where('name', $class_name)->first()){
            return false;
        }

        $newClass = self::create([
            'name' => $class_name,
            'teacher_id' => auth()->user()->id
        ]);

        return $newClass;
    }
}
