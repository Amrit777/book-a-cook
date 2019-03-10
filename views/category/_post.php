<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<section class="s-content">
	<?php Pjax::begin(['enablePushState' => true]);?>

	<div class="row narrow">
		<div class="col-full s-content__header aos-init aos-animate"
			data-aos="fade-up">
			<h1>Category: <?= $model->title?></h1>
			<p class="lead"><?= $model->content ?></p>
		</div>
	</div>
	<div class="row masonry-wrap">
		<div class="masonry">
			<div class="grid-sizer"></div>
				<?php
    
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '/post/_list',
        'summary' => false,
        'layout' => '{items}<div class="custom_pgn">{pager}</div>',
        'pager' => [
            'linkOptions' => [
                'class' => 'pgn__num'
            ]
        ]
    ]);
    ?>
		</div>
	</div>
		<?php Pjax::end();?>
	
</section>