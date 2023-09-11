<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalStudents extends Model
{
    protected $table = "local_students";

    protected $fillable = [
        'student_type',
        'id_number',
        'name',
        'age',
        'gender',
        'city',
        'mobile_number',
        'grades',
        'email'
    ];

    public function allStudent()
    {
        return $this->hasOne(AllStudents::class, 'local_student_id');
    }
}
