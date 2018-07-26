<?php

namespace app\module\api\models;

use yii\helpers\Json;

class ResponseHelper{

    const INTERNAL_SERVER_ERROR = 500;
    const NOT_FOUND = 404;
    const BAD_REQUEST = 400;
    const METHOD_NOT_ALLOWED = 405;    
    const SUCCESS = 200;
    const FORBIDDEN = 403;

    private static function getResponse($code,$data){
        return [
            'code' => $code,
            'data' => $data
        ];
    }

    public static function generateSuccessResponse($data){
        return self::getResponse(self::SUCCESS,$data);
    }

    public static function generateErrorResponse(){
        return self::getResponse(self::INTERNAL_SERVER_ERROR,"Opps, Something wrong in server");
    }

    public static function generateNotFoundResponse(){
        return self::getResponse(self::NOT_FOUND,"Data not found");
    }

    public static function generateBadRequestResponse($data){
        return self::getResponse(self::BAD_REQUEST,is_null($data) ? "Data not valid" : $data);
    }

    public static function generateInvalidMethodResponse(){
        return self::getResponse(self::METHOD_NOT_ALLOWED,"Method not allowed");
    }

    
    public static function generateForbiddenAccess(){
        return self::getResponse(self::FORBIDDEN,"FORBIDDEN ACCESS");
    }
    
    

}