<?php

namespace App\Repositories;

use App\Models\Course;
use Exception;

Class CourseRepository
{
    public function getAll(){
        try {
            /* With relation of 'registration' table. 
                So, the available seats can be calculated through 
                difference b/w capacity and row count of the course in 'registration' 
            */
            return Course::select('*')->withCount('registeredStudents')->get();
        } catch (Exception $e) {
            return null;
        }
    }
}