<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "M2Y4K_usuario".
 *
 * @property int $id
 * @property string|null $clave_empleado
 * @property string|null $nombre
 * @property string|null $apellido_paterno
 * @property string|null $apellido_materno
 * @property int|null $sueldo_mensual
 * @property string|null $fecha_ingreso
 * @property string|null $fecha_baja
 * @property string|null $curp
 * @property string|null $rfc
 * @property int|null $papelera
 * @property int|null $activo
 *
 * @property Cuenta[] $cuentas
 * @property Pago[] $pagos
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'M2Y4K_usuario';
    }


    public function extraFields(){


        return ['cuentas'];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'papelera', 'activo'], 'integer'],
            [['fecha_ingreso', 'fecha_baja'], 'safe'],
            [['sueldo_mensual'],'string'],
            [['clave_empleado'], 'string', 'max' => 10],
            [['nombre', 'apellido_paterno', 'apellido_materno'], 'string', 'max' => 100],
            [['curp', 'rfc'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave_empleado' => 'Clave Empleado',
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'sueldo_mensual' => 'Sueldo Mensual',
            'fecha_ingreso' => 'Fecha Ingreso',
            'fecha_baja' => 'Fecha Baja',
            'curp' => 'Curp',
            'rfc' => 'Rfc',
            'papelera' => 'Papelera',
            'activo' => 'Activo',
        ];
    }



    /**
     * Gets query for [[Cuentas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCuentas()
    {
        return $this->hasMany(Cuenta::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::class, ['usuario_id' => 'id']);
    }
}
