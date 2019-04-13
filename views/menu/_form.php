<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->getCategoryList()) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'time_to_prepare')->textInput() ?>
<?php
echo $form->field ( $model, 'file' )->widget ( \kartik\file\FileInput::classname (), [ 
		'options' => [ 
				'accept' => 'image/*' 
		],
		'pluginOptions' => [ 
				'initialPreviewShowDelete' => false,
				
				'initialPreview' => [ 
						$model->profileImage () 
				],
				'overwriteInitial' => true 
		
		] 

] );
?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
