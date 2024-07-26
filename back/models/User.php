<?php

namespace app\models;

use Yii;
use app\models\BaseModel;
use yii\web\IdentityInterface;
use app\components\StringHelper;
use Firebase\JWT\JWT;


class User extends BaseModel implements IdentityInterface
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['username', 'password','name','email'], 'required'],
            [['username','email'], 'unique'],
            ['password', 'string', 'min' => 6],
            [
                'password',
                'match',
                'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                'message' => Yii::t('app','La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un caracter especial')
            ],

            [['refresh_token','access_token','recover_token'], 'string', 'max' => '400']
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Nombre'),
            'email' => Yii::t('app', 'Correo'),
            
            'profile_id'=>Yii::t('app','Perfil'),
            'username'=>Yii::t('app','Usuario'),
            'password'=>Yii::t('app','Contraseña'),
            'created' => Yii::t('app', 'Creado'),
            'updated' => Yii::t('app', 'Modificado'),
            'creator' => Yii::t('app', 'Creador'),
            'editor' => Yii::t('app', 'Editor'),
            'trash' => Yii::t('app', 'Papelera'),
            'active' => Yii::t('app', 'Activo'),
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {

                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    public static function findByUsername($username){
        $user=static::findOne(['username'=>trim($username)]);
        return $user;
    }

    public static function findByEmail($email){
        $user=static::findOne(['email'=>trim($email)]);
        return $user;
    }


    public static function findByRecoverToken($token){
        $user=static::findOne(['recover_token'=>trim($token)]);
        return $user;
    }

    public static function findByRefreshToken($token){
        $user=static::findOne(['refresh_token'=>trim($token)]);
        return $user;
    }

    // IdentityInterface methods

    public static function findIdentity($id)
    {
        return static::findOne((int)$id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => trim($token)]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        // Not used for token-based authentication
    }

    public function validateAuthKey($authKey)
    {
        // Not used for token-based authentication
    }

    // Access token generation and validation

    public function generateRefreshToken()
    {
        

        $payload=['id'=>$this->id,
                  'hash'=>Yii::$app->getSecurity()->generateRandomString()
                ];
        $this->refresh_token = JWT::encode($payload, Yii::$app->params['jwtSecret'], 'HS256');
        $this->save();

        return $this->refresh_token;


    }

    public function generateAccessToken(){



        $payload=['username'=>$this->username,
                  'exp'=>time()+Yii::$app->params['access_token_expiration'],
                  'hash'=>Yii::$app->getSecurity()->generateRandomString(16)
                  //'exp'=>time()+30
                ];
        $this->access_token = JWT::encode($payload, Yii::$app->params['jwtSecret'], 'HS256');
        $this->save();
        return $this->access_token;

        
    }
    
    
    public function generateRecoverToken(){
        

        $payload=['username'=>$this->username,
                  'hash'=>Yii::$app->getSecurity()->generateRandomString(16),
                  'exp'=>time()+3600
        ];
        $this->recover_token = JWT::encode($payload, Yii::$app->params['jwtSecret'], 'HS256');

        $this->save();
    
        return $this->recover_token;

    }

    public function validateAccessToken($token)
    {
        return $this->access_token === $token;
    }

    // Password validation

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function getIdentity($id)
    {
        return static::findOne((int)$id);
    }


    public function getProfile(){
        return $this->hasOne(Profile::class, ['id' => 'profile_id']);
    }



/*
    public function can(){

        
    }*/
}