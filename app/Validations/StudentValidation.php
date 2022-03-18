<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;
use App\Rules\RegistrationRule;

Class StudentValidation
{
    public function register($request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'course_id' => 'required|integer|exists:course,id',
            'student_id' => 'required|integer|exists:student,id|unique:registration,student_id,null,id,course_id,'.$request->get('course_id')
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $validator = Validator::make($data, [
            'course_id' => [new RegistrationRule],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }
}