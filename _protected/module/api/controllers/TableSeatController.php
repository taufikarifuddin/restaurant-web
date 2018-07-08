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
                if( $tableSeat->save() ){
                    return ResponseHelper::generateSuccessResponse('success');
                }else{
                    return ResponseHelper::generateErrorResponse('success');
                }
            }else{
                return ResponseHelper::generateBadRequestResponse('Table with number '.$post.' has been setted');
            }
        }   
        return ResponseHelper::generateBadRequestResponse('Bad Request');
    }

}