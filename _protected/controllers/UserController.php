<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use \app\models\UserTopup;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerOrder = new \yii\data\ArrayDataProvider([
            'allModels' => $model->orders,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerOrder' => $providerOrder,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $passwordTemp = "";
        if ($model->loadAll(Yii::$app->request->post())) {
            $passwordTemp = $model->password_hash;
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
            $model->rePassword = $model->password_hash;
            if ( $model->saveAll() ){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $model->password_hash = $passwordTemp;
                $model->rePassword = $passwordTemp;
            }
        } 
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Export User information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerOrder = new \yii\data\ArrayDataProvider([
            'allModels' => $model->orders,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerOrder' => $providerOrder,
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

    public function actionTopup(){

        $listUser = \yii\helpers\ArrayHelper::map(User::find()
            ->where(['role' => \app\models\Role::CUSTOMER])
            ->all(),'id','username');

        $userTopup = new UserTopup();

        if( Yii::$app->request->post() && $userTopup->load(Yii::$app->request->post()) ){
           
            $user = User::findOne($userTopup->userId);
            if( !is_null($user) ){
                $user->current_saldo += $userTopup->saldo;
                if( $user->save() ){
                    Yii::$app->session->setFlash('success', "Success topup ".$userTopup->saldo." to ".$user->username);
                    $this->redirect(\yii\helpers\Url::to(['user/view','id' => $user->id]));
                }else{
                    var_dump($user->errors);
                    die();
                    Yii::$app->session->setFlash('error', "Error, failed topup saldo to user. cause : ".$user->errors);
                }
            }
        }

        return $this->render('topup',[
            'data' => $listUser,
            'model' => $userTopup
        ]);
    }

    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Order
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddOrder()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Order');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formOrder', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
