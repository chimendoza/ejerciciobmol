<?php

namespace app\controllers;

use Yii;
use yii\base\DynamicModel;
use yii\rest\ActiveController;


class UsuarioController extends ActiveController
{

    public $modelClass='app\models\Usuario';


    public function actions(){

        $actions=parent::actions();

        $actions['index']['dataFilter']=[
            'class'=>'yii\data\ActiveDataFilter',
            'searchModel'=>(new DynamicModel(['nombre']))->addRule(['nombre'],'string')
        ];

        return $actions;

    }



}
?>