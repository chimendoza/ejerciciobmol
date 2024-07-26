<?php

namespace app\components;
use Yii;
use yii\base\Component;

class DirectoryHelper extends Component{



    /**se manejan cargas de archivos separados por directorios nombrados por fecha
       con esto se evita concentrar toda la carga de imágenes en un solo directorio
       y evitar que se vuelva una lista demasiado grande para leer desde el disco
    **/
    function getCompanyFolder($folder='images')
    {
        $root=Yii::getAlias('@webroot');
        $id=Yii::$app->params['company_slug'];
        $ds=DIRECTORY_SEPARATOR;
        if($id){
            $company_folder=$root.$ds.$folder.$ds.$id;
        }else{
            //si no existe el company id se usa una carpeta llamada shared que si no existe se crea en la siguiente condición
            $company_folder=$root.$ds.$folder.$ds.'shared';
        }

        //si no existe el directorio se crea
        if(!is_dir($company_folder)){
            mkdir($company_folder);
        }


               $date_folder=date('d-m-Y');
             
                $generated_folder=$company_folder.$ds.$date_folder;
                if(!is_dir($generated_folder)){
                    mkdir($generated_folder);
                }

                return $generated_folder;

        }





    }

    


?>