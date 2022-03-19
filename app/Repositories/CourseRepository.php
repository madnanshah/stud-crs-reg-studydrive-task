<?php

namespace App\Repositories;

use App\Models\Course;
use Exception;

Class CourseRepository
{
    // We named this function "getAll". As we are in CourseRepository, 
    // So, it will be understandable that, we are getting all courses
    public function getAll(){
        try {
            return Course::all();
        } catch (Exception $e) {
            return false;
        }
    }
}