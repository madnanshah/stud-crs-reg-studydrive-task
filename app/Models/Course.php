<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';
    protected $appends = ['availability'];

    // gets courses registered by students (rows in table registration) 
    public function registeredStudents()
    {
        return $this->hasMany(Registration::class, 'course_id', 'id');
    }

    // if course is avaialble or not
    public function getAvailabilityAttribute(){
        return $this->registeredStudents()->count() < $this->capacity;
    }
}
