<?php

namespace app\models;

class FoodType{

    public static function foodType($type){
        if( $type == 1 || $type ){
            return 'Makanan';
        }
        return 'Minuman';
    }

}