<?php

namespace app\module\api\controllers;;

use Yii;
use yii\rest\ActiveController;
use app\module\api\models\ResponseHelper;
use app\models\User;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
    public $enableCsrfValidation = false;

    public function behaviors(){

        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Access-Control-Allow-Origin' => ['*'],
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['authenticator'] = [
            'except' => ['options'],
        ];

        if( isset($behaviors['authenticator']) )
            unset($behaviors['authenticator']);
        
        
        return $behaviors;

    }

    public function actionLogin(){
        $post = Yii::$app->request->post();    
        if( $post ){
            if( !is_null($post['username']) && !is_null($post['password']) ){
                $user = User::find()
                ->where(['username' => $post['username']])
                ->one();
                
                if( !is_null($user) ){
                    if ( Yii::$app->getSecurity()->validatePassword($post['password'],$user->password_hash) ){
                        $user->password_hash = null;
                        return ResponseHelper::generateSuccessResponse([
                            'status' => true,
                            'message' => 'Login Berhasil',
                            'user' => $user
                        ]);                                
                    }
                }

                return ResponseHelper::generateSuccessResponse([
                    'status' => false,
                    'message' => 'Username / Password salah'
                ]);                                
            }

        }

        return ResponseHelper::generateInvalidMethodResponse();
    }
}
