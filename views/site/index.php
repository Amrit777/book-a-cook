<?php
if (! empty($bannerModel)) {
    echo Yii::$app->controller->renderPartial("_banner", [
        'bannerModel' => $bannerModel
    ]);
}
?>
<section class="s-content">
	<div class="row masonry-wrap">
		<div class="masonry" style="position: relative; height: 3554.53px;">
			<div class="grid-sizer"></div>
				<?= Yii::$app->controller->renderPartial('/post/_post', ['dataProvider' => $dataProvider]);?>
		</div>
	</div>
</section>