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

        if(!$validated){
            $response = $this->service->register($request->all());
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
            else{
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
        else{
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
