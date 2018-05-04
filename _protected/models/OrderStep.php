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

}