<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "M2Y4K_branch".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $telephone
 * @property string|null $mobile
 * @property int|null $sort_order
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $trash
 * @property int|null $active
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'M2Y4K_branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','mobile','address'],'requred'],
            [['address'], 'string'],
            [['sort_order', 'trash', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'telephone', 'mobile'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'sort_order' => 'Sort Order',
            'created' => 'Created',
            'updated' => 'Updated',
            'trash' => 'Trash',
            'active' => 'Active',
        ];
    }
}
