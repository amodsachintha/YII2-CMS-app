<?php

namespace app\controllers;

use app\models\Apikey;
use app\models\Category;
use app\models\Count;
use app\models\Media;
use app\models\Post;
use app\models\Tag;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $count = new Count();
        $count->postCount = Post::find()->count();
        $count->mediaCount = Media::find()->count();
        $count->categoryCount = Category::find()->count();
        $count->tagCount = Tag::find()->count();
        $count->userCount = User::find()->count();
        $count->apikeyCount = Apikey::find()->count();

        $postsQuery = Post::find();

        $users = ArrayHelper::getColumn(User::find()->select(['name'])->all(), 'name');
        $userPostArray = [];
        $i=1;
        foreach ($users as $user) {
            $c2 = Post::find()
                ->joinWith(['user'])
                ->where(['user.name' => $user])
                ->count();

            $userPostArray[$i]['name'] = $user;
            $userPostArray[$i]['count'] = $c2;
            $i++;
        }

        $fullMonths = [
            '1' => 'January',
            '2' => 'Febuary',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];
        $months = [
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12',
        ];
        $postsArray = [];
        foreach ($months as $month) {
            $c1 = $postsQuery
                ->where(['AND',
                        ['>=', 'created_at', date('Y') . "-" . $month . "-" . "01"],
                        ['<=', 'created_at', date('Y') . "-" . $month . "-" . "31"]]
                )->count();

            $postsArray[$month] = $c1;
        }

        return $this->render('index', [
            'count' => $count,
            'textMonths' => $fullMonths,
            'fullMonths' => $months,
            'postsPerMonth' => $postsArray,
            'postsPerUser' => $userPostArray
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionPosts()
    {
        $search = YII::$app->request->get('search');
        if ($search !== '' && isset($search)) {
            $posts = Post::find()
                ->where(['LIKE', 'title', $search])
                ->orWhere(['LIKE', 'content', $search])
                ->all();
            $count = Post::find()
                ->where(['LIKE', 'title', $search])
                ->orWhere(['LIKE', 'content', $search])->count();
            if ($count > 0) {
                $message = "<div class='alert alert-success alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            <strong>" . $count . "</strong> result(s) found!</div>";
            } else {
                $message = "<div class='alert alert-danger alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            No posts matching posts for <strong>" . $search . "</strong> found!
                            </div>";
            }
            return $this->render('posts', [
                'posts' => $posts,
                'search' => $search,
                'count' => $count,
                'message' => $message
            ]);
        }

        return $this->render('posts', [
            'posts' => Post::find()->all()
        ]);
    }

}
