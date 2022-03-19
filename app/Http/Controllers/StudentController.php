<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Validations\StudentValidation;
use App\Helpers\ResponseHelper;
use Config;

class StudentController extends Controller
{
    /**
     * @var StudentService
     */
    // We are in StudentController (Controller of Student), we named it as "$service".
    // So it will be understandable that this is an instance of "StudentService" (Service of Student)
    private StudentService $service;

    /**
     * @var StudentValidation
     */
    // We are in StudentController (Controller of Student), we named it as "$validation". 
    // So it will be understandable that this is instance of "StudentValidation" (Validation of Student)
    private StudentValidation $validation;

    /**
     * @param StudentService $service
     */
    public function __construct(StudentService $service, StudentValidation $validation)
    {
        $this->service = $service;
        $this->validation = $validation;
    }

    public function register(Request $request){
        $validated = $this->validation->register($request);

        // check if data sent in request is valid 
        // the validation returns null if all data is valid
        if(is_null($validated)){
            // call to create row through StudentService to RegistrationRepository
            $response = $this->service->register($request->get('data'));

            // check if the creation call above returned some data
            // it will be false, if create (insert) call got any exception (handled in RegistrationRepository)
            if($response){
                return response()->json(
                    ResponseHelper::generateResponse(
                        true,
                        Config::get('constants.RESPONSE_CODES.SUCCESS'),
                        'You have registered for this course successfully!',
                        $response
                    )
                );
            }
            else // case when create (insert) call in RegistrationRepository faces some exception
            {
                return response()->json(
                    ResponseHelper::generateResponse(
                        false,
                        Config::get('constants.RESPONSE_CODES.SERVER_ERROR'),
                        Config::get('constants.RESPONSE_MESSAGES.SERVER_ERROR'),
                        $response
                    )
                );
            }
        }
        else // the case when validation fails ($validated is not null)
        {
            if($validated){ // when any rule of validation not passes
                return response()->json(
                    ResponseHelper::generateResponse(
                        false,
                        Config::get('constants.RESPONSE_CODES.BAD_REQUEST'),
                        Config::get('constants.RESPONSE_MESSAGES.BAD_REQUEST'),
                        $validated
                    )
                );
            }
            else // when any exception occurs while validating data ($validated is false)
            {
                return response()->json(
                    ResponseHelper::generateResponse(
                        false,
                        Config::get('constants.RESPONSE_CODES.SERVER_ERROR'),
                        Config::get('constants.RESPONSE_MESSAGES.SERVER_ERROR'),
                        $validated
                    )
                );
            }
        }
    }
}
