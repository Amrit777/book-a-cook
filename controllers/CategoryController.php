<?php

namespace app\controllers;

use app\components\BaseController;
use app\models\Category;
use app\models\CategorySearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\Menu;
use yii\data\ActiveDataProvider;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController {
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'POST' 
								] 
						] 
				] 
		];
	}
	
	/**
	 * Lists all Category models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new CategorySearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Category model.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	public function actionMenu($id) {
		$model = Menu::find ()->where ( [ 
				'category_id' => $id 
		] );
		$modelCat = Category::findOne ( $id );
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $model 
		] );
		return $this->render ( "_post", [ 
				'dataProvider' => $dataProvider,
				'title' => $modelCat->title 
		] );
	}
	
	/**
	 * Creates a new Category model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Category ();
		
		if ($model->load ( Yii::$app->request->post () )) {
			if ($_FILES) {
				$model->saveUploadedFile ( $model, 'file' );
			}
			$model->create_user_id = \Yii::$app->user->id;
			if ($model->save ()) {
				return $this->redirect ( [ 
						'view',
						'id' => $model->id 
				] );
			} else {
				print_r ( $model->getErrors () );
				exit ();
			}
		}
		
		return $this->render ( 'create', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Updates an existing Category model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		$old_file = $model->file;
		
		if ($model->load ( Yii::$app->request->post () )) {
			if (isset ( $_FILES ['Category'] ['name'] ['file'] ) && ! empty ( $_FILES ['Category'] ['name'] ['file'] )) {
				$imageFile = $model->saveUploadedFile ( $model, 'file', $old_file );
			} else {
				$model->file = $old_file;
			}
			if ($model->save ()) {
				return $this->redirect ( [ 
						'view',
						'id' => $model->id 
				] );
			}
		}
		
		return $this->render ( 'update', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Deletes an existing Category model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the Category model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Category the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Category::findOne ( $id )) !== null) {
			return $model;
		}
		
		throw new NotFoundHttpException ( Yii::t ( 'app', 'The requested page does not exist.' ) );
	}
}
