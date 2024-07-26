<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use app\models\User;

use app\models\Profile;
use Firebase\JWT\JWT;
use yii\filters\Cors;
use yii\base\ErrorException;
use yii\helpers\Json;

class AuthController extends Controller
{


    /*
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

      
        
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET','POST','PATCH','PUT','DELETE','OPTIONS','HEAD'],
                'Access-Control-Allow-Headers' => ['content-type'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        


        return $behaviors;
    }*/


    public function actionIndex(){

        

        /*
        $token = Yii::$app->request->headers->get('Authorization');
        $token=str_replace(['Bearer',' '],'',$token);

        $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key(Yii::$app->params['jwtSecret'], 'HS256'));
        print_r($decoded);
        //echo Yii::getAlias('@webroot');
        */

    }


    public function actionRecoverpassword(){

        

        $email = Yii::$app->request->post('email');

        $user=User::findByEmail($email);

        if($user){

            $token=$user->generateRecoverToken();


                /*
                    Yii::$app->mailer->compose('auth/recoverpassword',['token'=>$token])
                    ->setFrom('me@domain.com')
                    ->setTo('to@domain.com')
                    ->setSubject('AREA - Recuperar contraseña')
                    ->send();*/

            
                    return ['message'=>Yii::t('app','Correo de recuperación enviado')];



            

        }else{

            Yii::$app->response->statusCode = 404;//Not found
            return ['message' => Yii::t('app','Usuario no encontrado')];

        }



    }


    public function actionRefreshaccesstoken(){

        $token = Yii::$app->request->post('token');


        try {

            
            //$decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key(Yii::$app->params['jwtSecret'], 'HS256'));

            $user=User::findByRefreshToken($token);
                if($user){
                    return ['token'=>$user->generateAccessToken(),'refresh_token'=>$user->generateRefreshToken()];
                }else{
                    Yii::$app->response->setStatusCode(404);
                    Yii::$app->response->data = ['error' => Yii::t('app','Usuario no encontrado')];
                    Yii::$app->end();
                }

            } catch (\Exception $e) {

                Yii::$app->response->setStatusCode(401);
                Yii::$app->response->data = ['error' => Yii::t('app','Token inválido')];
                Yii::$app->end();
            }




    }


    public function actionResetpassword(){

        $token = Yii::$app->request->post('token');
        $password = Yii::$app->request->post('password');


        try {

            
            $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key(Yii::$app->params['jwtSecret'], 'HS256'));

            $user=User::findByRecoverToken($token);
            if($user){

                $user->password=Yii::$app->security->generatePasswordHash($password);

                if($user->validate()){


                    $user->save();
                    return ['message' => Yii::t('app','Contraseña cambiada correctamente')];

                }else{

                    Yii::$app->response->statusCode = 422;//422 Error de validación
                    return ['message' => Yii::t('app','Hubo errores de validación'),'errors'=>$user->getErrors()];
    
                    
                    
                }
            }else{
                
                Yii::$app->response->setStatusCode(404);
                return ['error' => Yii::t('app','Usuario no encontrado')];
            }


                

            } catch (\Firebase\JWT\ExpiredException $e) {
                Yii::$app->response->setStatusCode(401);
                Yii::$app->response->data = ['error' => Yii::t('app','Token expirado')];
                Yii::$app->end();
            } catch (\Exception $e) {

                Yii::$app->response->setStatusCode(401);
                Yii::$app->response->data = ['error' => Yii::t('app','Token inválido')];
                Yii::$app->end();
            }




    }

    public function actionLogin()
    {


        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');


        $user=User::findByUsername($username);

        if ($user!=null && $user->validatePassword($password)) {

            $profile=Profile::find()->where(['id'=>$user->profile_id])->one();

            return ['token'=>$user->generateAccessToken(),'refresh_token'=>$user->generateRefreshToken(),'name'=>$user->name,'profile'=>$profile->name];
        } else {
            Yii::$app->response->statusCode = 401;
            return ['status' => 'error', 'message' => 'Usuario o contraseña incorrectos'];
        }        
        
 
        

    }



    public function actionLogout()
    {
        // Aquí realizamos la lógica de cierre de sesión
        return ['status' => 'success', 'message' => 'Cierre de sesión exitoso'];
    }
}
