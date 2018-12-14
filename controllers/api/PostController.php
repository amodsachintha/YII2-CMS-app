<?php

namespace app\controllers\api;

use app\models\Apikey;
use app\models\Post;
use Yii;
use yii\web\Response;
use yii\web\Controller;

class PostController extends Controller
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
           return Post::find()->with('category')->with('tags')->with('medias')->asArray()->all();
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
            $post = Post::findOne($id);
            if (!$post) {
                return ['msg' => '404: Not Found'];
            }
            return [
                'post' => $post,
                'category' => $post->category,
                'tags' => $post->tags,
                'media' => $post->medias
            ];
        }
    }

}
