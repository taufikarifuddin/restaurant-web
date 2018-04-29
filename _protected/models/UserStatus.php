<?php

namespace app\models;

class UserStatus{

    const ACTIVE = 1;
    const NON_ACTIVE = 2;
    const DELETED = 3;

    public static function getList(){
        return [
            [ 
                'id' => self::ACTIVE,
                'name' => 'ACTIVE'
            ],
            [ 
                'id' => self::NON_ACTIVE,
                'name' => 'NON_ACTIVE'
            ],
            [ 
                'id' => self::DELETED,
                'name' => 'DELETED'
            ],                       
        ];
    }

    public static function getName( $id = self::ACTIVE ){
        $data = self::getList();
        return $data[$id-1]['name'];
    }
}