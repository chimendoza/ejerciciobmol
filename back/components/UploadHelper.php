<?php

namespace app\components;
use Yii;
use yii\base\Component;
use yii\imagine\Image;
use app\components\DirectoryHelper;
use app\components\StringHelper;
use yii\db\ActiveQuery;


class UploadHelper extends Component{



    public static function processImage($model,$field){
        $unique=$model->id.date('Ymdhisms');
            
        
        $name_parts=explode('.',$model->$field->name);
        $ext=array_pop($name_parts);

        $fname=StringHelper::clear(implode('',$name_parts));


        $thumbname=$unique.$fname.'-sm.'.$ext;
        $filename=$unique.$fname.'_.'.$ext;
        $res=$unique.$fname.'.'.$ext;
        $file = DirectoryHelper::getCompanyFolder().DIRECTORY_SEPARATOR.$filename;
        $filethumb = DirectoryHelper::getCompanyFolder().DIRECTORY_SEPARATOR.$thumbname;
        $fileres = DirectoryHelper::getCompanyFolder().DIRECTORY_SEPARATOR.$res;
        $model->$field->saveAs($file);
        Image::resize($file, 800, 600)->save($fileres);
        Image::thumbnail($file, 250, 200)->save($filethumb);
        
        if(file_exists($file) && is_file($file)){
            unlink($file);
        }
        $model->$field = str_replace(Yii::getAlias('@webroot'),'',$fileres);
        $query = new ActiveQuery($model::className());
        $query->createCommand()->update($model::tableName(), [$field => $model->$field], 'id ='.$model->id)->execute();
    

    }


    public static function processFile($model,$field){
        $unique=$model->id.date('Ymdhisms');

        $name_parts=explode('.',$model->$field->name);
        $ext=array_pop($name_parts);
        $fname=StringHelper::clear(implode('',$name_parts));
        $filename=$unique.$fname.'_.'.$ext;
        $file = DirectoryHelper::getCompanyFolder('uploads').DIRECTORY_SEPARATOR.$filename;

        $model->$field->saveAs($file);
        
        $model->$field = str_replace(Yii::getAlias('@webroot'),'',$file);
        $query = new ActiveQuery($model::className());
        $query->createCommand()->update($model::tableName(), [$field => $model->$field], 'id ='.$model->id)->execute();
    

    }




}


?>