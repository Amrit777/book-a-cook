<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = Yii::t('app', 'Update Post: ' . $model->title, [
    'nameAttribute' => '' . $model->title
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Posts'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="post-update">

	<h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render('_form', ['model' => $model,'file' => $file])?>

</div>
