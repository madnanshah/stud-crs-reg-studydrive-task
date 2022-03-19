<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Helpers\ResponseHelper;
use Config;

class CourseController extends Controller
{
    /**
     * @var CourseService
     */
    private CourseService $service;

    /**
     * @param CourseService $service
     */
    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    public function index(){

        $response = $this->service->getAll();
        if($response){ // $response is not null even there is no course in DB.
            return response()->json(
                ResponseHelper::generateResponse(
                    true,
                    Config::get('constants.RESPONSE_CODES.SUCCESS'),
                    'Please select a course.',
                    $response
                )
            );
        }
        else{ // $response will be 'false' if there is any exception while retreiving courses from BD.
            return response()->json(
                ResponseHelper::generateResponse(
                    false,
                    Config::get('constants.RESPONSE_CODES.SERVER_ERROR'),
                    Config::get('constants.RESPONSE_MESSAGES.SERVER_ERROR'),
                    null
                )
            );
        }
    }
}
