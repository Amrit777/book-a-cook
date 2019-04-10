<?php

namespace app\components;

use app\models\User;
use app\modules\media\models\Media;
use yii\helpers\Html;
use yii\imagine\Image;
use yii\web\UploadedFile;

class BaseActiveRecord extends \yii\db\ActiveRecord {
	const STATE_INACTIVE = 0;
	const STATE_ACTIVE = 1;
	const STATE_DELETED = 2;
	public function getStateOptions() {
		return [ 
				self::STATE_ACTIVE => \Yii::t ( 'app', 'Active' ),
				self::STATE_INACTIVE => \Yii::t ( 'app', 'In Active' ),
				self::STATE_DELETED => \Yii::t ( 'app', 'Deleted' ) 
		];
	}
	public function getStateBadges() {
		$states = $this->getStateOptions ();
		if ($this->state_id == self::STATE_ACTIVE) {
			return '<span class="label label-success">' . $states [self::STATE_ACTIVE] . '</span>';
		} elseif ($this->state_id == self::STATE_INACTIVE) {
			return '<span class="label label-default">' . $states [self::STATE_INACTIVE] . '</span>';
		} else if ($this->state_id == self::STATE_DELETED) {
			return '<span class="label label-danger">' . $states [self::STATE_DELETED] . '</span>';
		}
		return "Not Set";
	}
	public function beforeSave($insert) {
		if (parent::beforeSave ( $insert )) {
			if ($insert) { // only on insert
				if (isset ( $this->create_user_id )) {
					$this->create_user_id = \Yii::$app->user->id;
				}
				if (isset ( $this->created_on )) {
					$this->created_on = date ( "Y-m-d H:i:s" );
				}
			} else {
				if (isset ( $this->updated_on )) {
					$this->updated_on = date ( "Y-m-d H:i:s" );
				}
			}
			return true;
		}
		return false;
	}
	public function profileImage($options = [], $default = "user.png") {
		$modelFile = "";
		if ($this->hasAttribute ( "profile_image" )) {
			if (! empty ( $this->profile_image )) {
				$modelFile = $this->profile_image;
			}
		}
		if ($this->hasAttribute ( "file" )) {
			if (! empty ( $this->file )) {
				$modelFile = $this->file;
			}
		}
		if (! empty ( $modelFile ) && file_exists ( UPLOAD_PATH . '/' . $modelFile ) && ! is_dir ( UPLOAD_PATH . '/' . $modelFile )) {
			$file = [ 
					'/uploads/' . $modelFile 
			];
		} else {
			$file = \yii::$app->urlManager->createAbsoluteUrl ( 'themes/img/' . $default );
		}
		
		if (empty ( $options )) {
			$options = [ 
					'class' => 'img-responsive' 
			];
		}
		
		return Html::img ( $file, $options );
	}
	public function beforeValidate() {
		return parent::beforeValidate ();
	}
	public function saveUploadedFile($model, $attribute = 'file_name', $oldFile = null) {
		$imageFile = UploadedFile::getInstance ( $model, $attribute );
		
		if (! empty ( $imageFile )) {
			$thumbDir = UPLOAD_PATH . '/' . 'thumbnail/';
			if (! file_exists ( $thumbDir )) {
				mkdir ( $thumbDir, 0777, true );
			}
			$time = time ();
			$fileName = $imageFile->baseName . '-' . $time . '.' . $imageFile->extension;
			$imageFile->saveAs ( UPLOAD_PATH . '/' . $fileName );
			$originFile = UPLOAD_PATH . '/' . $fileName;
			$thumbFile = $thumbDir . $imageFile->baseName . '_' . time () . '-thumb' . '_200x200' . '.' . $imageFile->extension;
			Image::thumbnail ( $originFile, 200, 200 )->save ( $thumbFile, [ 
					'quality' => 80 
			] );
			$this->setAttribute ( $attribute, $fileName );
			if (! empty ( $oldFile ) && file_exists ( UPLOAD_PATH . '/' . $oldFile )) {
				unlink ( UPLOAD_PATH . '/' . $oldFile );
			}
			if (! empty ( $oldThumbFile ) && file_exists ( UPLOAD_PATH . '/' . 'thumbnail/' . $oldThumbFile )) {
				unlink ( UPLOAD_PATH . '/thumbnail/' . $oldThumbFile );
			}
		}
		return true;
	}
	
	/*
	 * get files of any model or by passing id of the model,
	 * and size -> one or all
	 *
	 */
	public function getFile() {
		if ($modelId !== null)
			$model_id = $modelId;
		else
			$model_id = $model->id;
		
		$media = Media::find ()->where ( [ 
				'model_type' => get_class ( $model ),
				'model_id' => $model_id 
		] );
		
		if ($type !== null) {
			$media = $media->andWhere ( [ 
					'type_id' => $type 
			] );
		}
		
		if ($sizeOne == true) {
			$media = $media->one ();
		} else {
			$media = $media->all ();
		}
		return $media;
	}
	
	/*
	 * to check if file exists for a model,
	 * returns file, for now only extension
	 */
	public function fileExists() {
		$data = [ ];
		$file = "";
		$data ['status'] = 'NOK';
		if ($this->hasAttribute ( "file" )) {
			$file = $this->file;
		}
		if (! empty ( $file )) {
			if (file_exists ( UPLOAD_PATH . '/' . $file )) {
				$data ['status'] = 'OK';
				$data ['ext'] = pathinfo ( $file, PATHINFO_EXTENSION );
			}
		}
		return $data;
	}
	
	/*
	 * get file name,
	 * returns html img src
	 *
	 */
	public function displayImage($file, $default = 'default.jpg', $options = [], $thumbnail = false) {
		if (! empty ( $file ) && file_exists ( UPLOAD_PATH . '/' . $file ) && ! is_dir ( UPLOAD_PATH . '/' . $file )) {
			if ($thumbnail) {
				$file = [ 
						'/uploads/thumbnail/_200x200' . $file 
				];
			} else {
				$file = [ 
						'/uploads/' . $file 
				];
			}
		} else {
			$file = \yii::$app->urlManager->createAbsoluteUrl ( 'themes/img/' . $default );
		}
		
		if (empty ( $options )) {
			$options = [ 
					'class' => 'img-responsive' 
			];
		}
		
		return Html::img ( $file, $options );
	}
	
	/*
	 * get files from media model,
	 * return html img src
	 *
	 */
	public function getImageFile($model, $default = null, $options = [], $attribute = 'file_name', $title = "Image", $img = true) {
		if (empty ( $options )) {
			$options = [ 
					'class' => 'img-responsive',
					'title' => $title 
			];
		}
		if (! empty ( $model->file )) {
			
			$fileDir = UPLOAD_PATH . '/' . $model->file;
			$filename = '/uploads/' . $model->file;
			
			if (file_exists ( $fileDir ) && ! is_dir ( $fileDir )) {
				if ($img == true) {
					$file = [ 
							$filename 
					];
					return Html::img ( $file, $options );
				} else {
					return '/blog' . $filename;
				}
			}
		}
		
		if (empty ( $default ))
			$default = "default.jpg";
		
		if (file_exists ( 'themes/img/' . $default )) {
			$filename = \yii::$app->urlManager->createAbsoluteUrl ( 'themes/img/' . $default );
		} else {
			$filename = \yii::$app->urlManager->createAbsoluteUrl ( 'themes/img/' . $default );
		}
		
		if (! empty ( $filename )) {
			if ($img == true) {
				$file = [ 
						$filename 
				];
				echo Html::img ( $file, $options );
			} else {
				return $filename;
			}
		}
	}
	public function saveFile($media, $model, $attribute = 'file_name', $oldFile = null, $oldThumbFile = null) {
		$imageFile = UploadedFile::getInstance ( $media, 'file_name' );
		if (! empty ( $imageFile )) {
			$thumbDir = UPLOAD_PATH . '/' . 'thumbnail/';
			if (! file_exists ( $thumbDir )) {
				mkdir ( $thumbDir, 0777, true );
			}
			$time = time ();
			$fileName = $imageFile->baseName . '-' . $time . $imageFile->extension;
			$imageFile->saveAs ( UPLOAD_PATH . '/' . $fileName );
			$originFile = UPLOAD_PATH . '/' . $fileName;
			$thumbnFile = $thumbDir . $imageFile->baseName . '_' . time () . '-thumb' . '_200x200' . '.' . $imageFile->extension;
			// Generate a thumbnail image
			Image::thumbnail ( $originFile, 200, 200 )->save ( $thumbnFile, [ 
					'quality' => 80 
			] );
			$media->size = $imageFile->size;
			$media->extension = $imageFile->extension;
			$media->file_name = $fileName;
			$media->thumb_file = $imageFile->baseName . '_' . $time . '-thumb' . '_200x200' . '.' . $imageFile->extension;
			$media->original_name = $imageFile->baseName;
			$media->model_type = get_class ( $model );
			$media->model_id = $model->id;
			$media->title = isset ( $model->title ) ? $model->title : 'Not set';
			
			if (! empty ( $oldFile ) && file_exists ( UPLOAD_PATH . '/' . $oldFile )) {
				unlink ( UPLOAD_PATH . '/' . $oldFile );
			}
			if (! empty ( $oldThumbFile ) && file_exists ( UPLOAD_PATH . '/' . 'thumbnail/' . $oldThumbFile )) {
				unlink ( UPLOAD_PATH . '/thumbnail/' . $oldThumbFile );
			}
		}
		if ($media->save ()) {
			return true;
		}
		
		return false;
	}
	public function saveMultipleFile($media, $model, $oldDelete = false, $attribute = 'file_name') {
		$imageFiles = UploadedFile::getInstances ( $media, 'file_name' );
		$thumbDir = UPLOAD_PATH . '/' . 'thumbnail/';
		if (! file_exists ( $thumbDir )) {
			mkdir ( $thumbDir, 0777, true );
		}
		
		if ($oldDelete == true) {
			$exists = Media::find ()->where ( [ 
					'model_id' => $model->id,
					'model_type' => get_class ( $model ) 
			] )->all ();
			if (! empty ( $exists )) {
				foreach ( $exists as $delFile ) {
					unlink ( UPLOAD_PATH . '/' . $delFile->file_name );
					unlink ( $thumbDir . $delFile->thumb_file );
					$delFile->delete ();
				}
			}
		}
		
		if (! empty ( $imageFiles )) {
			foreach ( $imageFiles as $imageFile ) {
				$time = time ();
				$fileName = $imageFile->baseName . '_' . time () . '.' . $imageFile->extension;
				$thumbFile = '_200x200' . $fileName;
				$imageFile->saveAs ( UPLOAD_PATH . '/' . $fileName );
				
				$originFile = UPLOAD_PATH . '/' . $fileName;
				$thumbnFile = $thumbDir . $thumbFile;
				// Generate a thumbnail image
				Image::thumbnail ( $originFile, 200, 200 )->save ( $thumbnFile, [ 
						'quality' => 80 
				] );
				$media = new Media ();
				$media->size = $imageFile->size;
				$media->extension = $imageFile->extension;
				$media->thumb_file = $thumbFile;
				$media->file_name = $fileName;
				$media->original_name = $imageFile->baseName;
				$media->model_type = get_class ( $model );
				$media->model_id = $model->id;
				$media->title = isset ( $model->title ) ? $model->title : 'Not set';
				if (! $media->save ()) {
					$data ['error'] = $media->getErrors ();
					print_r ( $data );
					exit ();
					return $data;
				}
			}
			return true;
		}
		return false;
	}
	public function errorString() {
		$str = '';
		$errors = $this->errors;
		
		if (! empty ( $errors )) {
			foreach ( $errors as $error ) {
				$str .= $error ['0'] . "</br>";
			}
		}
		return $str;
	}
	public static function deleteRelatedAll($query = null) {
		$models = self::find ()->where ( $query )->all ();
		if (! empty ( $models )) {
			foreach ( $models as $model ) {
				if ($model instanceof Media && file_exists ( UPLOAD_PATH . '/' . $model->file_name )) {
					unlink ( UPLOAD_PATH . '/' . $model->file_name );
				}
				$model->delete ();
			}
		}
	}
	public function getCreatedUser() {
		if (isset ( $this->create_user_id )) {
			$user = User::findOne ( $this->create_user_id );
			
			if (! empty ( $user )) {
				return Html::a ( $user->full_name, [ 
						'/user/view',
						'id' => $user->id 
				], [ 
						'title' => $user->full_name 
				] );
			}
		}
		return "Not Set";
	}
	public function getParentTitle($relation, $url) {
		$funName = "get" . ucfirst ( $relation );
		if (method_exists ( $this, $funName )) {
			$model = $this->$funName ()->one ();
			if (! empty ( $model )) {
				return Html::a ( $model->title, [ 
						"/$url/view",
						'id' => $model->id 
				], [ 
						'title' => $model->title 
				] );
			}
		}
		return "Not Set";
	}
}