<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PostShare */

$this->title = Yii::t('app', 'Create Post Share');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Shares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-share-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
