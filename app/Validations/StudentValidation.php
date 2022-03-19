<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;
use App\Rules\RegistrationRule;
use Exception;

Class StudentValidation
{
    public function register($request)
    {
        $data = $request->all();

        try{
            $validator = Validator::make($data,[
                'data' => 'required',
                'data.course_id' => 'required|integer|exists:course,id',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            }
            // validates row uniqueness (to avoid double registration) and max capacity
            $validator = Validator::make($data, [
                'data.student_id' => 'required|integer|exists:student,id|unique:registration,student_id,null,id,course_id,'.$data['data']['course_id'],
                'data.course_id' => [new RegistrationRule], 
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            }

        }catch(Exception $e){
            return false;
        }
    }
}