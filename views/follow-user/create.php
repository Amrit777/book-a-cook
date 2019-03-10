<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FollowUser */

$this->title = Yii::t('app', 'Create Follow User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Follow Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="follow-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
