<?php

namespace app\models;

class OrderStep{

    const REVIEW_KASIR = 1;
    const APPROVED_KASIR = 2;
    const DOING_BY_KOKI = 3;
    const DONE_READY_FOR_USER = 4;
    const NEED_USER_REVIEW = 5;
    const SUCCESS = 6;
    const CANCELED = 7;

    public static function getName($step){
        switch($step){
            case self::REVIEW_KASIR :
                return "Review Kasir";
            case self::APPROVED_KASIR :
                return "Approved Kasir";
            case self::DOING_BY_KOKI :
                return "Sedang dimasak";
            case self::NEED_USER_REVIEW :
                return "Perlu Review User";
            case self::SUCCESS :
                return "Pesanan Selesai";
            case self::CANCELED :
                return "Pesanan Gagal";
            case self::DONE_READY_FOR_USER :
                return "Siap untuk user";            
            default : return "Pesanan Gagal";
        }
    }

}