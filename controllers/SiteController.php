<?php
namespace app\controllers;

use app\components\BaseController;
use app\models\ContactForm;
use app\models\Page;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\Post;
use yii\base\Controller;

class SiteController extends BaseController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'logout'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'about',
                            'faq',
                            'contact',
                            'privacy-policy',
                            'support',
                            'term-condition',
                            'test'
                        ],
                        'allow' => true,
                        'roles' => [
                            '?',
                            '@',
                            '*'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => [
                        'post'
                    ]
                ]
            ]
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (User::isAdmin() || User::isManager()) {
            return $this->redirect([
                '/user/dashboard'
            ]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        $bannerModel = Post::find()->where([
            'type_id' => 1
        ])
            ->orderBy("rand()")
            ->limit(3)
            ->all();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'bannerModel' => $bannerModel
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                
                return $this->refresh();
            }
        }
        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionFaq()
    {
        $model = Page::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        return $this->render('faq', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionTermCondition()
    {
        return $this->render('term-condition');
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

    public function actionPrivacyPolicy()
    {
        return $this->render('privacy-policy');
    }

    public function actionSupport($slug)
    {
        $model = Page::find()->where([
            'state_id' => Page::STATE_ACTIVE,
            'slug' => $slug
        ])->one();
        
        if (empty($model)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        return $this->render('support', [
            'model' => $model
        ]);
    }
}
