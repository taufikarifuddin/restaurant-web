<?php

namespace app\models;

class Role{

    const CUSTOMER = 1;
    const KOKI = 2;
    const KASIR = 3;
    const ADMIN = 4;
    
    public static function getList(){
        return [
            [ 
                'id' => self::CUSTOMER,
                'name' => 'CUSTOMER'
            ],
            [ 
                'id' => self::KOKI,
                'name' => 'KOKI'
            ],
            [ 
                'id' => self::KASIR,
                'name' => 'KASIR'
            ],            
            [ 
                'id' => self::ADMIN,
                'name' => 'ADMIN'
            ]
        ];
    }

    public static function getName($id = self::CUSTOMER){
        $data = self::getList();
        return $data[$id-1]['name'];
    }

}