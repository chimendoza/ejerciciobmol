<?php

namespace app\components;

use yii\base\Component;

class StringHelper extends Component{


    public static function clear($text)
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text); // Eliminar acentos
        $text = preg_replace('/[^a-zA-Z0-9 -]/', '', $text); // Eliminar caracteres especiales excepto espacios y guiones
        $text = str_replace(' ', '-', $text); // Reemplazar espacios con guiones
        
        return $text;
    }

    public static function slug($text){

        return strtolower(self::clear($text));


    }


    
}

?>