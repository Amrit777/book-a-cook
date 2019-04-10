<?php

namespace app\controllers;

use Yii;
use app\models\BookMenu;
use app\models\BookMenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\widgets\Alert;

/**
 * BookMenuController implements the CRUD actions for BookMenu model.
 */
class BookMenuController extends Controller {
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
	 * Lists all BookMenu models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new BookMenuSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single BookMenu model.
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
	public function actionState($id) {
		$model = $this->findModel ( $id );
		$model->state_id = 2;
		$model->updateAttributes ( [ 
				'state_id' 
		] );
		
		\Yii::$app->session->setFlash ( "success", "get the payment from customer." );
		return $this->render ( 'view', [ 
				'model' => $model 
		] );
	}
	public function actionPay($id) {
		$model = $this->findModel ( $id );
		$model->state_id = 3;
		$model->updateAttributes ( [ 
				'state_id' 
		] );
		
		\Yii::$app->session->setFlash ( "success", "You have successfully paid your cook" );
		return $this->render ( 'view', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Creates a new BookMenu model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate($id) {
		if (empty ( \Yii::$app->user->id )) {
			\Yii::$app->session->setFlash ( "error", "Please Login to book." );
			return $this->redirect ( [ 
					'/user/login' 
			] );
		}
		$this->layout = "frontend";
		$model = new BookMenu ();
		
		if ($model->load ( Yii::$app->request->post () )) {
			$model->menu_id = $id;
			
			$model->create_user_id = \Yii::$app->user->id;
			
			if ($model->save ()) {
				$this->layout = "frontend";
				
				\Yii::$app->session->setFlash ( "success", "Your booking is done. This will be notified to the Cook" );
				return $this->redirect ( [ 
						'view',
						'id' => $model->id 
				] );
			} else {
				\Yii::$app->session->setFlash ( "error", $model->getErrors () );
			}
		}
		return $this->render ( '/book-menu/create', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Updates an existing BookMenu model.
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
	 * Deletes an existing BookMenu model.
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
	 * Finds the BookMenu model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return BookMenu the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = BookMenu::findOne ( $id )) !== null) {
			return $model;
		}
		
		throw new NotFoundHttpException ( 'The requested page does not exist.' );
	}
}
