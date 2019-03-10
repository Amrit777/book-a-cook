<?php
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="deal-index">
	<div class="panel">
		<div class="panel-body">
			<div class="row">
		<?=ListView::widget(['dataProvider' => $dataProvider,'layout' => '{summary}</br>{items}<div class="clearfix"></div>{pager}','itemView' => '_file']);?>
		</div>
		</div>
	</div>
</div>