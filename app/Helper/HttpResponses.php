<?php
namespace App\Helper;

class HttpResponses{
    const CODE_SUCCESS = 200;
    const CODE_CREATED = 201;
    const CODE_BADREQ  = 400;

    public static function success($data = [], $messages = "Success", $code = self::CODE_SUCCESS){
        return response()->json([
            'status'    => true,
            'message'   => $messages,
            'data'      => $data
        ],$code);
    }

    public static function error($messages = "Failed", $code = self::CODE_BADREQ){
        return response()->json([
            'status'    => false,
            'message'   => $messages
        ],$code);
    }
}