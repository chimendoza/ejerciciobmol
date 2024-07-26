<?php


namespace app\components;
use Yii;

class BaseModelGenerator extends \yii\gii\generators\model\Generator
{

    

    public $baseClass = 'app\models\BaseModel';



    public function init()
    {


        //$this->templates=Yii::getAlias('@yii/gii/generators/model');
        
        parent::init();
    }



    public function getName()
    {
        return 'Generar un modelo';
    }

    public function getDescription()
    {
        return 'Genera un modelo para este proyecto';
    }



    public function defaultTemplate()
    {
        return Yii::getAlias('@yii/gii/generators/model/default');
    }



    public function formView()
    {
      
        return Yii::getAlias('@yii/gii/generators/model/form.php');
    }
    



}

?>