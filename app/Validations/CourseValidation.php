<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;
use App\Rules\RegistrationRule;

Class CourseValidation
{
    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => ['required', new RegistrationRule],
            'student_id' => 'required|integer|exists:student,id|unique:registration,student_id,null,id,course_id,'.$request->get('course_id')
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    }
}