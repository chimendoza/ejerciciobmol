<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "M2Y4K_pago".
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $cuenta_id
 * @property int|null $cantidad
 * @property string|null $fecha_pago
 * @property int|null $tipopago_id
 *
 * @property Cuenta $cuenta
 * @property Tipopago $tipopago
 * @property Usuario $usuario
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'M2Y4K_pago';
    }


    public function extraFields(){

        return ['cuenta','tipopago','usuario'];

    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'cuenta_id', 'cantidad', 'tipopago_id'], 'integer'],
            [['fecha_pago'], 'safe'],
            [['cuenta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cuenta::class, 'targetAttribute' => ['cuenta_id' => 'id']],
            [['tipopago_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipopago::class, 'targetAttribute' => ['tipopago_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'cuenta_id' => 'Cuenta ID',
            'cantidad' => 'Cantidad',
            'fecha_pago' => 'Fecha Pago',
            'tipopago_id' => 'Tipopago ID',
        ];
    }

    /**
     * Gets query for [[Cuenta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCuenta()
    {
        return $this->hasOne(Cuenta::class, ['id' => 'cuenta_id']);
    }

    /**
     * Gets query for [[Tipopago]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipopago()
    {
        return $this->hasOne(Tipopago::class, ['id' => 'tipopago_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::class, ['id' => 'usuario_id']);
    }
}
