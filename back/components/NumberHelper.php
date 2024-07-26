<?php

namespace app\components;

use yii\base\Component;

class NumberHelper extends Component{


    function parseFloat($number)
    {
        return preg_replace('/[^0-9\.]/','',$number);

    }


    
}

?>