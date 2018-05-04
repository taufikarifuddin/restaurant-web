<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Order;
use app\models\OrderStep;

class OperationController extends Controller{

    public function actionChef(){        
        return $this->render('chef');
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

}