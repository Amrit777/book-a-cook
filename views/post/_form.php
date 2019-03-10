<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'type_id')->dropDownList($model->getTypeOptions(),['prompt' => 'select post type...']) ?>
    
    <?= $form->field($model, 'category_id')->dropDownList($model->getCategoryIdOptions(),['prompt' => 'select category...']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_original_content')->dropDownList($model->getIsOriginalOptions(),['prompt' => 'select...']) ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'state_id')->dropDownList($model->getStateOptions(),['prompt' => 'select status...']) ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'create_user_id')->textInput() ?>
    <?php echo $form->field($file, 'file_name[]')->fileInput(['multiple' => true])?>
    
    <?php
    $model->tags = $model->getTags();
    echo $form->field($model, 'tags')
        ->widget(Select2::classname(), [
        'data' => $model->getTagsOptions(),
        'options' => [
            'placeholder' => 'Select tag...',
            'multiple' => true
        ],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [
                ',',
                ' '
            ],
            'maximumInputLength' => 10
        ]
    ])
        ->label('#Tags');
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
