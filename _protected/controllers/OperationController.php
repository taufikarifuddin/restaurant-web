<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Order;
use app\models\OrderStep;
use app\models\NotificationService;
use app\models\EmiterModel;

class OperationController extends Controller{

    public function actionChef(){      
        
        $order = Order::find()->where(['step' => OrderStep::DOING_BY_KOKI]);

        if( Yii::$app->request->post() ){
            $id = $app->request->post('offset');
            //increment the offsets
            $order = $order->offset( $id + 1 );
        }

        $order = $order->all();
        return $this->render('chef',[
            'orders' => $order
        ]);
    }

    public function actionCashier(){
        $order = Order::find()->where(['step' => OrderStep::REVIEW_KASIR]);

        if( Yii::$app->request->post() ){
            $id = $app->request->post('offset');
            //increment the offsets
            $order = $order->offset( $id + 1 );
        }

        $order = $order->all();
        return $this->render('cashier',[
            'orders' => $order
        ]);
    }

    public function actionSubmitOrder(){
        NotificationService::emit(EmiterModel::SUBMIT_ORDER,[
            'message' => 'say hai'
        ]);
        return "success";
    }

}