<?php

namespace app\controllers;

use app\models\Tag;
use Yii;
use app\models\Post;
use app\models\searches\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use DateTime;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $post = $this->findModel($id);
        return $this->render('view', [
            'model' => $post,
            'media' => $post->medias,
            'tags' => $post->tags
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post()['Post'];
            $tags = Yii::$app->request->post()['tags'];

            $data['user_id'] = Yii::$app->user->identity->getId();
            $date = new DateTime();

            $data['created_at'] = $date->format('Y-m-d H:i:s');
            $data['updated_at'] = $date->format('Y-m-d H:i:s');

//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return $tags;

            $model->category_id = $data['category_id'];
            $model->user_id = $data['user_id'];
            $model->title = $data['title'];
            $model->content = $data['content'];
            $model->created_at = $data['created_at'];
            $model->updated_at = $data['updated_at'];

            if($model->save()){
                $tagArray = explode(',',$tags);
                foreach ($tagArray as $tag){
                    $tagObj = new Tag();
                    $tagObj->title = $tag;
                    $tagObj->save();
                    $model->link('tags',$tagObj);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post()['Post'];
            $tags = Yii::$app->request->post()['tags'];

            $date = new DateTime();
            $data['updated_at'] = $date->format('Y-m-d H:i:s');

            $model->category_id = $data['category_id'];
            $model->title = $data['title'];
            $model->content = $data['content'];
            $model->updated_at = $data['updated_at'];

            if($model->save()){
                $tagArray = explode(',',$tags);
                foreach ($tagArray as $tag){
                    $tagObj = new Tag();
                    $tagObj->title = $tag;
                    $tagObj->save();
                    $model->link('tags',$tagObj);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'tags' => $model->tags
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
