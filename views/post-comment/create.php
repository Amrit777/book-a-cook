<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PostComment */

$this->title = Yii::t('app', 'Create Post Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
