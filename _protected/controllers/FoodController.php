<?php

namespace app\controllers;

use Yii;
use app\models\Food;
use app\models\FoodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FoodImage;

/**
 * FoodController implements the CRUD actions for Food model.
 */
class FoodController extends Controller
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

    /**
     * Lists all Food models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FoodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Food model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelForm = new \app\models\UploadForm();
        $model = $this->findModel($id);
        $providerFoodImage = new \yii\data\ArrayDataProvider([
            'allModels' => $model->foodImages,
        ]);
        $providerOrderItem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->orderItems,
        ]);

        if( $modelForm->load(Yii::$app->request->post()) && 
                Yii::$app->request->post() ){            
            $modelForm->imageFile = \yii\web\UploadedFile::getInstance($modelForm, 'imageFile');
            $name = $modelForm->upload();
            if ( $name ) {
                $obj = new FoodImage();
                $obj->food_id = $modelForm->foodId;
                $obj->img = $name;
                $obj->save();
            }
        }

        return $this->render('view', [
            'modelForm' => $modelForm,
            'model' => $this->findModel($id),
            'providerFoodImage' => $providerFoodImage,
            'providerOrderItem' => $providerOrderItem,
        ]);
    }

    /**
     * Creates a new Food model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Food();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Food model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Food model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export Food information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerFoodImage = new \yii\data\ArrayDataProvider([
            'allModels' => $model->foodImages,
        ]);
        $providerOrderItem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->orderItems,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerFoodImage' => $providerFoodImage,
            'providerOrderItem' => $providerOrderItem,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    protected function findModel($id)
    {
        if (($model = Food::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAddFoodImage()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('FoodImage');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formFoodImage', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateFood(){
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $food = Food::findOne($id);
            if ( !is_null($food) ){
                $food->status = $food->status == 0 ? 1 : 0; 
                if( $food->save() ){
                    return true;
                }else{
                    var_dump($food->errors);
                }
            }
            return false;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
