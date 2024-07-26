<?php


namespace app\components;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\base\Controller;
use yii\db\ActiveQuery;
use app\components\AppConnection;
use yii\base\Exception;







class EventBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {



        if(strpos(Yii::$app->request->url,'gii/')!==false){
            //return;

        }



        /****Validado que no se pueda listar elementos de un catálogo que no corresponde a la misma empresa
         * que el usuario que está mandando la petición
         */
        Event::on(ActiveQuery::class, ActiveQuery::EVENT_INIT, function ($event) {
            /*
            $model = $event->sender;
            
            
            $aux=new $model->modelClass;
            $tableName = $aux->tableName();
            
            if ($aux->hasAttribute('company_id') && $model->modelClass!='app\models\User') {
                 $model->where=[$tableName.'.company_id'=>Yii::$app->params['company_id']]; 
            }*/

        });
        /****Validado que no se pueda eliminar,crear o editar elementos de un catálogo que no corresponde a la misma empresa
         * que el usuario que está mandando la petición
         */

        Event::on(BaseActiveRecord::class, BaseActiveRecord::EVENT_INIT, function ($event) {

            /*
            $model = $event->sender;


            if ($model->hasAttribute('company_id') && get_class($model)!='app\models\User' && get_parent_class($model)!='app\models\BaseModel'){

                
                $message='Hay un error con el sistema, esta acción no se puede realizar';
                if(defined('YII_ENV')){
                    $message='Esta clase debe extender a BaseModel si contiene el campo company_id';
                }
                throw new Exception($message);
            }*/

        });
        Event::on(AppConnection::class, AppConnection::EVENT_BEFORE_QUERY, function ($event) {



            /*

            $thesql=$event->sender::$thesql;
            $params=$event->sender::$theparams;

            

            if(strpos($thesql,Yii::$app->db->tablePrefix)===false){


                if(strpos($thesql,'{{%')!==false && strpos($thesql,'{{%user}}')===false && strpos($thesql,'{{%company}}')===false){
                    
                        if(strpos($thesql,'DELETE')!==false || strpos($thesql,'UPDATE')!==false || strpos($thesql,'INSERT')!==false){
                            
                            
                            
                            $pattern = '/\{\{%([a-zA-Z0-9_]+)\}\}/';
                            $isRelational=true;
                            if (preg_match_all($pattern, $thesql, $matches)) {
                                $tableNames = $matches[1];
                                foreach($tableNames as $name){
                                    if(strpos($name,'_')===false){
                                        $isRelational=false;
                                        break;
                                    }
                                }
                            }
                            
                            
                            
                            if(strpos($thesql,'company_id')===false && !$isRelational){


                                $message='Ocurrió un problema de privacidad, el contenido que estás intentando acceder es privado';
                                if(defined('YII_ENV')){

                                    
                                    $message=' La consulta no contiene el filtro de la compañia (company_id=Yii::app()->params["company_id"])'.PHP_EOL.$thesql;
                                }
                                throw new Exception($message);
                                
                            }
                        }
                }
                
            }

            */

        });



    }


}