<?php

namespace app\module\api\controllers;

use yii\rest\ActiveController;
use app\models\FoodCategory;

class FoodCategoryController extends ActiveController
{
    public $modelClass = 'app\models\FoodCategory';


    public function actionGetAll(){
        $foodCategory = FoodCategory::find()->all();

        $data = [];
        foreach($foodCategory as $k => $v){

            $foods = [];
            foreach($v->foods as $key => $val){
                $foods[] = [
                    'name' => $val['name'],
                    'desc' => $val['detail'],
                    'price' => $val['price'],
                    'status' => $val['status'],
                    'fotoPath' => '123',
                    'qty' => 0,
                    'id' => $val['id']
                ];
            }

            $item = [
                'name' => $v['name'],
                'foods' => $foods
            ];
            $data[] = $item;
        }
        return $data;
    }
}
