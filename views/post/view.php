<?php
use app\components\BasePageHeader;
use app\modules\media\models\Media;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Posts'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
    <?= BasePageHeader::widget() ?>

<div class="panel">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content',
            'meta_tag',
            'meta_title',
            'meta_description',
            'slug',
            'is_original_content',
            'created_on',
            'updated_on',
            [
                'attribute' => 'tags',
                'format' => 'raw',
                'value' => $model->getTags(true)
            ],
            [
                'attribute' => 'is_original_content',
                'format' => 'raw',
                'value' => $model->getIsOriginal()                
            ],
            [
                'attribute' => 'state_id',
                'format' => 'raw',
                'value' => $model->getStateBadges()
            ],
            'type_id',
            [
                'attribute' => 'create_user_id',
                'format' => 'raw',
                'value' => $model->getCreatedUser()
            ]
        ],
    ]) ?>
    
    </div>
<?php echo HtmlPurifier::process($model->content); ?>
			</div>
		</div>
	</div>
	<div class="panel">
		<div class="panel-body">
			<h4><?= Yii::t('app', 'Banner Images') ?></h4>
		<?php
$query = Media::find()->where([
    'model_id' => $model->id,
    'model_type' => get_class($model)
]);

$dataProvider = new ActiveDataProvider([
    'query' => $query
]);

echo $this->render('@app/modules/media/views/default/index', [
    'dataProvider' => $dataProvider
]);
?>

 </div>

	</div>

</div>
