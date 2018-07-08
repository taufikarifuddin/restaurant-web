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

    public function actionTable($action = null){

        $tables = \app\models\SeatTable::find();

        if( !is_null($action) && $action == 'free' ){
            $tables = $tables->where(['user_id' => NULL]);
        }

        $tables = $tables
            ->orderBy('seat_table_number')
            ->all();

        return $this->render('table',[
            'tables' => $tables
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
        $rejectedItem = [];        
        $dataTemp = [];
        if( $post && Yii::$app->request->isAjax ){
            foreach( $post['data'] as $k => $v ){
                $orderItem = OrderItem::findOne($v['id']);
                if( is_null($orderItem) ){
                    return false;
                }
                $orderItem->approved = $v['approved'] == 'true'? true : false;
                if( !$orderItem->approved ){
                    $orderItem->note = $v['note'];
                    $rejectedItem[] = [
                        'food' => $orderItem->food->name,
                        'note' => $orderItem->note
                    ];
                }
                if( !$orderItem->save() ){                    
                    var_dump($orderItem->errors);
                    return false;
                }
                $dataTemp[] = [
                    'qty' => $orderItem->qty,
                    'foodId' => $orderItem->food_id
                ];
            }

            $order = Order::findOne($post['order']);
            if( is_null($order) ){
                return false;
            }

            if( count($rejectedItem) == 0 ){
                $order->step = OrderStep::DOING_BY_KOKI;

                $user = \app\models\User::findOne($order->user_id);
                $user->current_saldo = $user->current_saldo - $order->total_price;
                
                if( is_null($user) ){
                    return false;
                }

                if( !$order->save() ){
                    $user->save();
                    var_dump($order->errors);
                    return false;
                }

                NotificationService::emit(EmiterModel::SUBMIT_TO_CHEF,[
                    'orderId' => $order->id
                ]);  

                NotificationService::emit(EmiterModel::NOTIFY_PROGRESS,[
                    'orderId' => $order->id,
                    'status' => \app\models\OrderStep::DOING_BY_KOKI,
                    'date' => $order->order_time,
                    'userId' => $order->user_id,
                    'saldo' =>  $user->current_saldo
                ]);  

                
                return true;
            }else{

                $order->delete();
                
                NotificationService::emit(EmiterModel::SEND_BACK_TO_USER,[
                    'reject' => $rejectedItem,
                    'orderItem' => $dataTemp,
                    'userId' => $order->user_id
                ]);  
                return true;
            }
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

                NotificationService::emit(EmiterModel::NOTIFY_PROGRESS,[
                    'orderId' => $order->id,
                    'status' => \app\models\OrderStep::SUCCESS,
                    'date' => $order->order_time,
                    'userId' => $order->user_id
                ]);  
    
                return true;
            }
        }
        return false;
    }
}