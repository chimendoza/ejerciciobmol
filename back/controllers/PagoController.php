<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Cuenta;
use app\models\Usuario;
use app\models\Tipopago;


class PagoController extends ActiveController
{

    public $modelClass='app\models\Pago';



    public function actionObtenercatalogos(){

        $usuarios=Usuario::find()->all();
        $cuentas=Cuenta::find()->all();
        $tipopagos=Tipopago::find()->all();

        return compact('usuarios','cuentas','tipopagos');
    }



}
?>