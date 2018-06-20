<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Order;
use app\models\OrderItem;
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

    public function actionConfirm(){
        $post = Yii::$app->request->post();
        if( $post && Yii::$app->request->isAjax ){
            foreach( $post['data'] as $k => $v ){
                $orderItem = OrderItem::findOne($v['id']);
                if( is_null($orderItem) ){
                    return false;
                }
                $orderItem->approved = $v['approved'] ? true : false;
                if( !$v['approved'] ){
                    $orderItem->approved = $v['note'];
                }
                if( !$orderItem->save() ){
                    var_dump($orderItem->errors);
                    return false;
                }
            }

            $order = Order::findOne($post['order']);
            if( is_null($order) ){
                return false;
            }
            $order->step = OrderStep::DOING_BY_KOKI;
            if( !$order->save() ){
                var_dump($order->errors);
                return false;
            }

            NotificationService::emit(EmiterModel::SUBMIT_TO_CHEF,[
                'orderId' => $order->id
            ]);  

            return true;
        }


        return false;
    }

    public function actionDone(){
        $post = Yii::$app->request->post();
        if( $post && Yii::$app->request->isAjax ){
            $order = Order::findOne($post['id']);
            if( is_null($order) ){
                return false;
            }
            $order->step = OrderStep::SUCCESS;
            if ( $order->save() ){
                return true;
            }
        }
        return false;
    }
}