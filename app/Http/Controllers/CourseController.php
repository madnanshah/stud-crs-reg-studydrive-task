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

        $courses = $this->service->getAll();
        if($courses){
            return response()->json(
                ResponseHelper::generateResponse(
                    true,
                    Config::get('constants.RESPONSE_CODES.SUCCESS'),
                    'Please select a course.',
                    $courses
                )
            );
        }
        else{
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
