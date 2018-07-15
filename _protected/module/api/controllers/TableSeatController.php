<?php

namespace app\module\api\controllers;

use Yii;
use yii\rest\ActiveController;

use app\module\api\models\ResponseHelper;
use app\models\SeatTable;

class TableSeatController extends ActiveController{

    public $modelClass = 'app\models\SeatTable';

    public function actionRegister(){
        $post = Yii::$app->request->post('seat');
        if( $post ){
            $tableSeat = SeatTable::findOne(['seat_table_number' => $post]);
            if( is_null($tableSeat) ){
                $tableSeat = new SeatTable();
                $tableSeat->seat_table_number = $post;
                $tableSeat->save();
            }
            return ResponseHelper::generateSuccessResponse('success');
        }   
        return ResponseHelper::generateBadRequestResponse('Bad Request');
    }

    public function actionLogin(){
        $post = Yii::$app->request->post();
        if( $post['user'] && $post['seat'] ){
            $tableSeat = SeatTable::findOne(['seat_table_number' => $post]);
            if( !is_null($tableSeat) ){
                $tableSeat->user_id = $post['user'];
                if( $tableSeat->save() ){
                    return ResponseHelper::generateSuccessResponse('success');
                }
            }
        }
        return ResponseHelper::generateBadRequestResponse('Bad Request');
    }

    public function actionLogout(){
        $post = Yii::$app->request->post();
        if( $post['seat'] ){
            $tableSeat = SeatTable::findOne(['seat_table_number' => $post]);
            if( !is_null($tableSeat) ){
                $tableSeat->user_id = NULL;
                if( $tableSeat->save() ){
                    return ResponseHelper::generateSuccessResponse('success');
                }
            }
        }
        return ResponseHelper::generateBadRequestResponse('Bad Request');
    }

}