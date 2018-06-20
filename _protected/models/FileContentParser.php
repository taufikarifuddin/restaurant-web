<?php

namespace app\models;

class FileContentParser extends \yii\base\Component{

    public function init(){

        $fileGetContents = file_get_contents("php://input");
        if( isset($fileGetContents) ){                
            $decodedFile = json_decode($fileGetContents,true);
            if( !is_null($decodedFile) ){
                $_POST = gettype($fileGetContents) == 'string' && strlen($fileGetContents) > 0 ? 
                $decodedFile : $_POST;    
                  
            }
        }      

        parent::init();
    }

}