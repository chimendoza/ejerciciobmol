<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property int $is_visible
 * @property string|null $permissions
 * @property int|null $sort
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $creator
 * @property string|null $editor
 * @property int|null $trash
 * @property int|null $active
 *
 * @property Company $company
 * @property User[] $users
 */
class Profile extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name'], 'required'],
            [['permissions'], 'string'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['creator', 'editor'], 'string', 'max' => 50],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'is_visible' => Yii::t('app', 'Is Visible'),
            'permissions' => Yii::t('app', 'Permissions'),
            'sort' => Yii::t('app', 'Sort'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'creator' => Yii::t('app', 'Creator'),
            'editor' => Yii::t('app', 'Editor'),
            'trash' => Yii::t('app', 'Trash'),
            'active' => Yii::t('app', 'Active'),
        ];
    }


    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['profile_id' => 'id']);
    }
}
