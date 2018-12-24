<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\searches\UserSearch;
use yii\base\Exception;
use yii\base\Security;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UnauthorizedHttpException;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['home', 'index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->role->name !== "SA"){
            throw new ForbiddenHttpException('You are not allowed to enter this section.');
        }
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->role->name !== "SA"){
            throw new ForbiddenHttpException('You are not allowed to enter this section.');
        }
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if(Yii::$app->user->identity->role->name !== "SA"){
            throw new ForbiddenHttpException('You are not allowed to enter this section.');
        }
        $model = new User();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post()['User'];
            $data['auth_key'] = str_split(md5(openssl_random_pseudo_bytes(8)), 10)[0];
            $data['access_token'] = md5(openssl_random_pseudo_bytes(8));
            try {
                $data['password'] = Yii::$app->getSecurity()->generatePasswordHash($data['password']);
            } catch (Exception $exception) {
                return $exception->getMessage();
            }

            $model->email = $data['email'];
            $model->role_id = $data['role_id'];
            $model->password = $data['password'];
            $model->name = $data['name'];
            $model->auth_key = $data['auth_key'];
            $model->access_token = $data['access_token'];

            if ($model->save()) {
                return $this->redirect(['index']);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->role->name !== "SA"){
            throw new ForbiddenHttpException('You are not allowed to enter this section.');
        }
        $model = $this->findModel($id);
        $model->password = null;

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post()['User'];
            $data['auth_key'] = $model->auth_key;
            $data['access_token'] = $model->access_token;
            try {
                $data['password'] = Yii::$app->getSecurity()->generatePasswordHash($data['password']);
            } catch (Exception $exception) {
                return $exception->getMessage();
            }

            $model->email = $data['email'];
            $model->role_id = $data['role_id'];
            $model->password = $data['password'];
            $model->name = $data['name'];
            $model->auth_key = $data['auth_key'];
            $model->access_token = $data['access_token'];

            if ($model->save()) {
                return $this->redirect(['index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->role->name !== "SA"){
            throw new ForbiddenHttpException('You are not allowed to enter this section.');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
