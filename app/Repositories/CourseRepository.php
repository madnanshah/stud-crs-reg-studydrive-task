<?php

namespace App\Repositories;

use App\Models\Course;
use Exception;

Class CourseRepository
{
    public function getAll(){
        try {
            return Course::all();
        } catch (Exception $e) {
            return null;
        }
    }
}