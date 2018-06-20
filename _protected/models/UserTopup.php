<?php

namespace app\models;

use yii\base\Model;

class UserTopup extends Model{

    public $userId,$saldo;
    
    public function rules()
    {
        return [
            [['userId','saldo'], 'required'],
            ['saldo', 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'userId' => 'User',
            'saldo' => 'Saldo'
        ];
    }
}