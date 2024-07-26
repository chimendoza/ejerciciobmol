<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "M2Y4K_cuenta".
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property string|null $banco
 * @property string|null $no_cuenta
 * @property string|null $clave_interbancaria
 * @property string|null $tipo_cuenta
 * @property string|null $sucursal
 * @property string|null $fecha_registro
 * @property int|null $papelera
 * @property int|null $activo
 *
 * @property Pago[] $pagos
 * @property Usuario $usuario
 */
class Cuenta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'M2Y4K_cuenta';
    }


    public function extraFields(){


        return ['usuario'];

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'papelera', 'activo'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['banco', 'sucursal'], 'string', 'max' => 80],
            [['no_cuenta', 'clave_interbancaria'], 'string', 'max' => 30],
            [['no_cuenta', 'clave_interbancaria'], 'unique'],
            [['tipo_cuenta'], 'string', 'max' => 20],
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
            'banco' => 'Banco',
            'no_cuenta' => 'No Cuenta',
            'clave_interbancaria' => 'Clave Interbancaria',
            'tipo_cuenta' => 'Tipo Cuenta',
            'sucursal' => 'Sucursal',
            'fecha_registro' => 'Fecha Registro',
            'papelera' => 'Papelera',
            'activo' => 'Activo',
        ];
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::class, ['cuenta_id' => 'id']);
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
