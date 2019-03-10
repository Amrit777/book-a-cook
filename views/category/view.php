<?php
use app\components\BasePageHeader;
use yii\widgets\DetailView;
use app\modules\media\models\Media;
use yii\data\ActiveDataProvider;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Banners'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-view">

    <?= BasePageHeader::widget() ?>

<div class="panel">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
  					<?=$model->displayImage($model->file,$default = 'user.png', $options = []);?>
				</div>
	<div class="col-md-9">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content',
            'created_on',
            'updated_on',
            'state_id',
            'type_id',
            'create_user_id',
        ],
    ]) ?>

	</div>
<?php echo HtmlPurifier::process($model->content); ?>
			</div>
		</div>
	</div>

</div>
