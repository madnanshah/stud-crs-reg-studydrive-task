<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';
    protected $appends = ['registered_students','is_available'];

    public function registeredStudents()
    {
        // One to many relationship with 'Registration' model ('registration' DB table)
        return $this->hasMany(Registration::class, 'course_id', 'id');
    }

    public function getRegisteredStudentsAttribute(){
        //total registered students to this course
        return $this->registeredStudents()->count();
    }

    public function getIsAvailableAttribute(){
        // if registered students are less then capacity, then true else false
        return $this->registeredStudents()->count() < $this->capacity;
    }
}
