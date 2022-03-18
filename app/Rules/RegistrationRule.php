<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Registration;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class RegistrationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $courseCapacity = Course::where('id',$value)->pluck('capacity');
        $registeredCount = Registration::where('course_id',$value)->count();
        return $courseCapacity ?
            ($registeredCount < $courseCapacity[0] ? true : false) : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The maximum capcity is filled.';
    }
}
