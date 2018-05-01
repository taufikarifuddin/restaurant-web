<?php

namespace app\models;

class FoodStatus{

    
    const AVAILABLE = 1;
    const NOT_AVAILABLE = 0;

    public static function getList(){
        return [
            [ 
                'id' => self::NOT_AVAILABLE,
                'name' => 'NOT AVAILABLE'
            ],
            [ 
                'id' => self::AVAILABLE,
                'name' => 'AVAILABLE'
            ],                          
        ];
    }

    public static function getName( $id = self::NOT_AVAILABLE ){
        $data = self::getList();
        return $data[$id]['name'];
    }
}