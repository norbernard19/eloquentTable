<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignStudents extends Model
{
    protected $table = "foreign_students";

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
        return $this->hasOne(AllStudents::class, 'foreign_student_id');
    }
}
