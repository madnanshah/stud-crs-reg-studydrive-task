<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';

    // gets courses registered by students (rows in table registration) 
    public function registeredStudents()
    {
        return $this->hasMany(Registration::class, 'course_id', 'id');
    }
}
