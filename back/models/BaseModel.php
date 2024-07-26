<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Exception;

class BaseModel extends ActiveRecord{


    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        return true;
    }


}