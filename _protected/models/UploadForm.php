<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile,$foodId;

    public function rules()
    {
        return [
            ['foodId','required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        $name = uniqid().time(). '.' . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::getAlias('@uploads').'/'. $name );
            return $name;
        } else {
            return false;
        }
    }
}