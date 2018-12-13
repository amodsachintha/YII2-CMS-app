<?php

namespace app\controllers\api;

use app\models\Post;
use Yii;
use app\models\User;
use yii\web\Response;
use yii\web\Controller;

class PostController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $posts = Post::find()->with('category')->with('tags')->with('medias')->asArray()->all();
        return $posts;
    }

    public function actionView($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Post::findOne($id);
        if(!$post){
            return ['err'=>'Not Found'];
        }
        return [
            'item'=>$post,
            'category'=>$post->category,
            'tags'=>$post->tags,
            'media'=>$post->medias
        ];
    }

}
