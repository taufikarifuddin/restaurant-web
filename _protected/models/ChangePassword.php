<?php

namespace app\models;

class ChangePassword extends \yii\base\Model{

    public $oldPassword,$rePassword,$password;

    public function rules(){
        return [
            [['oldPassword', 'rePassword','password'], 'required'],
            ['rePassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Repeat Password not match with Password" ],
        ];
    }

    public function attributeLabels(){
        return [
            'oldPassword' => 'Old Password',
            'password' => 'New Password',
            'rePassword' => 'Re-type Password'
        ];
    }

}