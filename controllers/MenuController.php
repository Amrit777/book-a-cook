<?php

namespace app\controllers;

use app\components\BaseController;
use app\models\Category;
use app\models\Menu;
use app\models\MenuSearch;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends BaseController {
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
	 * Lists all Menu models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new MenuSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Menu model.
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
	public function actionCategory($title) {
		$model = Category::find ()->select ( 'id' )->where ( [ 
				"like",
				'title',
				$title . '%',
				false 
		] )->column ();
		
		if (empty ( $model )) {
			throw new NotFoundHttpException ( Yii::t ( 'app', 'No data found.' ) );
		} else {
			$query = Menu::find ()->where ( [ 
					'IN',
					'category_id',
					$model 
			] );
			$dataProvider = new ActiveDataProvider ( [ 
					'query' => $query,
					'pagination' => [ 
							'pageSize' => 2 
					],
					'sort' => [ 
							'defaultOrder' => [ 
									'id' => SORT_DESC 
							] 
					] 
			] );
			return $this->render ( '/category/_post', [ 
					'dataProvider' => $dataProvider,
					'title' => $title 
			] );
		}
	}
	
	/**
	 * Creates a new Menu model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Menu ();
		
		if ($model->load ( Yii::$app->request->post () )) {
			$model->create_user_id = \Yii::$app->user->id;
			$model->file = UploadedFile::getInstance ( $model, 'file' );
			$model->file->saveAs ( 'uploads/' . $model->file->baseName . '.' . $model->file->extension );
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
	 * Updates an existing Menu model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		}
		
		return $this->render ( 'update', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Deletes an existing Menu model.
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
	public function actionDetail($title) {
		$this->layout = "frontend";
		$model = Menu::find ()->where ( [ 
				'like',
				'title',
				$title 
		] )->one ();
		if (empty ( $model )) {
			throw new NotFoundHttpException ( Yii::t ( 'app', 'The requested page does not exist.' ) );
		}
		
		return $this->render ( '/post/_detail-view', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Finds the Menu model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Menu the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Menu::findOne ( $id )) !== null) {
			return $model;
		}
		
		throw new NotFoundHttpException ( 'The requested page does not exist.' );
	}
}
