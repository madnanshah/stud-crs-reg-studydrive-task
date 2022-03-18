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
    private StudentService $service;

    /**
     * @var StudentValidation
     */
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

        // check if data sent in request is valid (the validation return null if all data is valid)
        if(!$validated){

            // call to create row through StudentService to RegistrationRepository
            $response = $this->service->register($request->all());

            // check if the creation call above returned some data
            //it will not be null even DB table has zero rows
            //it will be null only if creation call got any exception (handled in RegistrationRepository)
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
            else // case when creation call in RegistrationRepository faces some exception
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
        else // the case when data is not valid (validation fails)
        {
            return response()->json(
                ResponseHelper::generateResponse(
                    false,
                    Config::get('constants.RESPONSE_CODES.BAD_REQUEST'),
                    Config::get('constants.RESPONSE_MESSAGES.BAD_REQUEST'),
                    $validated
                )
            );
        }
    }
}
