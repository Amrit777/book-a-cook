<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SubHeader */

$this->title = Yii::t('app', 'Create Sub Header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Headers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
