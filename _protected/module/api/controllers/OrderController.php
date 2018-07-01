<?php

namespace app\module\api\controllers;

use Yii;
use yii\rest\ActiveController;
use app\module\api\models\ResponseHelper;
use app\models\Order;
use app\models\OrderItem;
use app\models\OrderStep;
use app\models\NotificationService;
use app\models\EmiterModel;

class OrderController extends ActiveController
{
    public $modelClass = 'app\models\Order';


    public function actionGetOrderUser(){

        $userId = Yii::$app->request->get('user_id');

        $data = Order::find()
            ->asArray()
            ->where(['user_id' => $userId])->all();


        return ResponseHelper::generateSuccessResponse([
            'orders' => $data
        ]);
    }

    public function actionCheckStatus(){

        $orderId = Yii::$app->request->get('order_id');

        $data = Order::findOne($orderId);

        if( is_null($data) ){
            return ResponseHelper::generateSuccessResponse([
                'orders' => $data
            ]);                
        }

        return ResponseHelper::generateSuccessResponse([
            'status' => OrderStep::getName($data->step)
        ]);
    }

    public function actionGetAllOrder($user = -1){

        $data = ORder::find()
            ->where(['user_id' => $user])
            ->all();

        $response = [];
        foreach( $data as $k => $v ){

            $items = [];

            foreach($v->orderItems as $k => $val){
                $items[] = [
                    'name' => $val->food->name,
                    'qty' => $val->qty,
                    'price' => $val->qty * $val->food->price
                ];        
            }

            $response[] = [
                'id' => $v->id,
                'date' => $v->order_time,
                'total' => $v->total_price,
                'items' => $items
            ];
        }


        return $response;
    }

    public function actionDoOrder(){
        $post = Yii::$app->request->post();
        if( $post ){
            $order = new Order();
            $order->user_id = $post['order_user_id'];
            $order->total_price = $post['order_total_price'];
            $order->table_number = $post['order_table_number'];
            if( $order->save() ){
                $orderItem = $post['order_item'];
                foreach( $orderItem as $k => $v ){
                    $orderItem = new OrderItem();
                    $orderItem->food_id = $v['food_id'];
                    $orderItem->qty = $v['food_qty'];
                    $orderItem->order_id = $order->id;                    
                    $orderItem->save();
                }                


                NotificationService::emit(EmiterModel::SUBMIT_ORDER,[
                    'orderId' => $order->id
                ]);

                return ResponseHelper::generateSuccessResponse([
                    'order_id' => $order->id,
                    'total' => $order->total_price
                ]);
            }

        }
        return ResponseHelper::generateInvalidMethodResponse();
    }
}
