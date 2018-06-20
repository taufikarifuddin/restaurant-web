<?php

namespace app\models\base;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the base model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $account_activation_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $role
 * @property integer $current_saldo
 *
 * @property \app\models\Order[] $orders
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    use \mootensai\relation\RelationTrait;

    public $rePassword;

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'orders'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['status', 'current_saldo'], 'integer'],
            [['username', 'email', 'password_hash', 'password_reset_token', 'account_activation_token'], 'string', 'max' => 255],            
            [['auth_key'], 'string', 'max' => 32],
//            [['role'], 'string', 'max' => 4],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['account_activation_token'], 'unique'],
            ['rePassword', 'compare', 'compareAttribute'=>'password_hash', 'message'=>"Repeat Password not match with Password" ],
            ['email','email']
            
            // [['lock'], 'default', 'value' => '0'],
            // [['lock'], 'mootensai\components\OptimisticLockValidator'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public static function findByUsername($username){
        return self::findOne(['username' => $username]);
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password',
            'rePassword' => 'Re-type Password',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'account_activation_token' => 'Account Activation Token',
            'role' => 'Role',
            'current_saldo' => 'Current Saldo',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(\app\models\Order::className(), ['user_id' => 'id']);
    }
   


    /**
     * @inheritdoc
     * @return \app\models\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\UserQuery(get_called_class());
    }



    //------------------------------------------------------------------------------------------------//
    // IDENTITY INTERFACE IMPLEMENTATION
    //------------------------------------------------------------------------------------------------//

    /**
     * Finds an identity by the given ID.
     *
     * @param  int|string $id The user id.
     * @return IdentityInterface|static
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds an identity by the given access token.
     *
     * @param  mixed $token
     * @param  null  $type
     * @return void|IdentityInterface
     * 
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     *
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Returns a key that can be used to check the validity of a given
     * identity ID. The key should be unique for each individual user, and
     * should be persistent so that it can be used to check the validity of
     * the user identity. The space of such keys should be big enough to defeat
     * potential identity attacks.
     *
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     * 
     * @param  string  $authKey The given auth key.
     * @return boolean          Whether the given auth key is valid.
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

//------------------------------------------------------------------------------------------------//
// IMPORTANT IDENTITY HELPERS
//------------------------------------------------------------------------------------------------//

    /**
     * Generates "remember me" authentication key. 
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Validates password.
     *
     * @param  string $password
     * @return bool
     * 
     * @throws \yii\base\InvalidConfigException
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model.
     *
     * @param  string $password
     * 
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
