<?php
namespace app\controllers;

use app\components\BaseController;
use app\models\Post;
use app\models\PostSearch;
use app\models\Tag;
use app\modules\media\models\Media;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\Category;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends BaseController
{

    /**
     *
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'POST'
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Post models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Post model.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionDetail($slug)
    {
        $this->layout = "frontend";
        $model = Post::findOne([
            'slug' => $slug
        ]);
        if (empty($model)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $this->render('_detail-view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $file = new Media();
        $tagIds = [];
        if ($model->load(Yii::$app->request->post())) {
            if (! empty($model->tags)) {
                foreach ($model->tags as $tags) {
                    if (is_numeric($tags)) {
                        $tagIds[] = $tags;
                    } elseif (is_string($tags)) {
                        $tagModel = Tag::findOne([
                            'title' => $tags
                        ]);
                        if (empty($tagModel))
                            $tagModel = new Tag();
                        $tagModel->title = $tags;
                        $tagModel->save();
                        $tagIds[] = $tagModel->id;
                    }
                }
            } else {
                $model->tags = "";
            }
            
            if (! empty($tagIds)) {
                $model->tags = implode(",", $tagIds);
            }
            if ($model->save()) {
                if (isset($_FILES) && ! empty($_FILES)) {
                    $saveFile = $model->saveMultipleFile($file, $model);
                    if ($saveFile) {
                        $model->updateAttributes([
                            'is_media' => Post::STATE_ACTIVE
                        ]);
                    }
                }
                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'file' => $file
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = new Media();
        $tagIds = [];
        
        if ($model->load(Yii::$app->request->post())) {
            if (! empty($model->tags)) {
                foreach ($model->tags as $tags) {
                    if (is_numeric($tags)) {
                        $tagIds[] = $tags;
                    } elseif (is_string($tags)) {
                        $tagModel = Tag::findOne([
                            'title' => $tags
                        ]);
                        if (empty($tagModel))
                            $tagModel = new Tag();
                        $tagModel->title = $tags;
                        $tagModel->save();
                        $tagIds[] = $tagModel->id;
                    }
                }
            } else {
                $model->tags = "";
            }
            
            if (! empty($tagIds)) {
                $model->tags = implode(",", $tagIds);
            }
            if ($model->save()) {
                if (isset($_FILES) && ! empty($_FILES)) {
                    $saveFile = $model->saveMultipleFile($file, $model, true);
                }
                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
            'file' => $file
        ]);
    }

    public function actionCategory($title)
    {
        $model = Category::findOne([
            'title' => $title
        ]);
        
        if (empty($model)) {
            throw new NotFoundHttpException(Yii::t('app', 'No data found.'));
        } else {
            $query = Post::find()->where([
                'category_id' => $model->id
            ]);
            $model = $this->findModel($model->id);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 2
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC
                    ]
                ]
            ]);
            return $this->render('/category/_post', [
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);
        }
    }

    public function actionTest()
    {
        print_r("kj");
        exit();
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect([
            'index'
        ]);
    }

    public function actionTags($tags)
    {
        $tagModel = Tag::findOne([
            'title' => $tags
        ]);
        
        if (! empty($tagModel)) {
            $model = Post::find()->where([
                'REGEXP',
                'tags',
                $tagModel->id
            ]);
            
            $dataProvider = new ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => 2
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC
                    ]
                ]
            ]);
            
            return $this->render('tag-posts', [
                'dataProvider' => $dataProvider,
                'model' => $tagModel
            ]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'No data found.'));
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
