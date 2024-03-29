<?php
use app\components\BasePageHeader;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Posts'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">
        <?=BasePageHeader::widget()?>
<div class="panel">
		<div class="panel-body">
			<h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render('_form', ['model' => $model,'file' => $file])?>
</div>
	</div>
</div>
