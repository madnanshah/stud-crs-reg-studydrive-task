<?php

namespace App\Helpers;


class ResponseHelper {

    public static function generateResponse($success, $code, $message, $content){
        $result = [];

        $result['success'] = $success;
        $result['code'] = $code;
        $result['message'] = $message;

        if($content != null){
            $result['content'] = $content;
        }
        return $result;
    }
}
