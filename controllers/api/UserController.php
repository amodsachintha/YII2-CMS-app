<?php

namespace app\controllers\api;

use Yii;
use app\models\User;
use yii\web\Response;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $users = User::find()->with('role')->asArray()->all();
        return $users;
    }

    public function actionView($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = User::findOne($id);
        if(!$user){
            return ['err'=>'Not Found'];
        }
        $user['password'] = 'HIDDEN';
        return $user;
    }

}
