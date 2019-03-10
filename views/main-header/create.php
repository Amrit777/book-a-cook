<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MainHeader */

$this->title = Yii::t('app', 'Create Main Header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Main Headers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
