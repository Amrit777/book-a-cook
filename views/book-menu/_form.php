<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$id = Yii::$app->request->get ( 'id' );

/* @var $this yii\web\View */
/* @var $model app\models\BookMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menu_id')->hiddenInput(['value' => $id])->label(false)?>

    <?=$form->field ( $model, 'booking_date' )->textInput(['placeholder' => "Please enter booking data eg;2019-04-10"])?>

    <?= $form->field ( $model, 'booking_time' )->textInput (['placeholder' =>  "Please enter booking time eg; 13:00"])?>

    <?= $form->field($model, 'number_of_person')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>