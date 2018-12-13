<?php

namespace app\controllers\api;

use Yii;
use app\models\User;
use yii\web\Response;
use yii\web\Controller;
use app\models\Apikey;

class UserController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $key = Yii::$app->request->get()['key'];
        } catch (\Exception $exception) {
            return ['msg' => ['401: Unauthorized', 'API Key not provided with request']];
        }
        $c = Apikey::find()->where(['key' => $key])->count();
        if (intval($c) === 0) {
            return ['msg' => '401: Unauthorized'];
        } else {
            $users = User::find()->with('role')->asArray()->all();
            return $users;
        }
    }

    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $key = Yii::$app->request->get()['key'];
        } catch (\Exception $exception) {
            return ['msg' => ['401: Unauthorized', 'API Key not provided with request']];
        }

        $c = Apikey::find()->where(['key' => $key])->count();
        if (intval($c) === 0) {
            return ['msg' => '401: Unauthorized'];
        } else {
            $user = User::findOne($id);
            if (!$user) {
                return ['msg' => '404: Not Found'];
            }
//            $user['password'] = 'HIDDEN';
            return $user;
        }
    }

}
