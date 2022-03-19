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
        $course = Course::where('id',$value)->first();
        // is_available field is appended in Course model 
        return $course->is_available;
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
