<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "M2Y4K_tipopago".
 *
 * @property int $id
 * @property string|null $nombre
 * @property int|null $papelera
 * @property int|null $activo
 *
 * @property Pago[] $pagos
 */
class Tipopago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'M2Y4K_tipopago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['papelera', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
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
        return $this->hasMany(Pago::class, ['tipopago_id' => 'id']);
    }
}
