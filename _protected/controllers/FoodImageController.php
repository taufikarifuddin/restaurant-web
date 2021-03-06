<?php

namespace app\controllers;

use Yii;
use app\models\FoodImage;
use app\models\FoodImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FoodImageController implements the CRUD actions for FoodImage model.
 */
class FoodImageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionDelete($id)
    {
        $foodImage = $this->findModel($id);
        $foodImage->deleteWithRelated();

        $imageFullPath = Yii::getAlias('@uploads/'.$foodImage->img);


        if( file_exists($imageFullPath) ){
            unlink($imageFullPath);
        }

        return $this->redirect(['food/view','id' => $foodImage->food_id]);
    }
    
    protected function findModel($id)
    {
        if (($model = FoodImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
