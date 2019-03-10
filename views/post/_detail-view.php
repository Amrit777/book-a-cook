<?php
use yii\helpers\Url;
?>
<section
	class="s-content s-content--narrow s-content--no-padding-bottom">
	<article class="row format-gallery">

		<div class="s-content__header col-full">
			<h1 class="s-content__header-title"><?= $model->title?></h1>
			<ul class="s-content__header-meta">
				<li class="date"><?= $model->created_on?></li>
				<li class="cat"><a
					href="<?= Url::toRoute(['/category/post','id'=>$model->category_id])?>"><?= $model->category->title?></a></li>
			</ul>
		</div>
		<!-- end s-content__header -->

		<div class="s-content__media col-full">
			<div class="s-content__slider slider">
				<div class="slider__slides">
<?php

$files = $model->getFile($model);
if (! empty($files)) {
    foreach ($files as $file) {
        ?>
        <div class="slider__slide">
        <?php
        echo $model->displayImage($file->file_name, $default = 'default.jpg', $options = [
            'sizes' => "(max-width: 2000px) 100vw, 2000px",
            'alt' => "Image"
        ]);
        ?>
        </div>
        <?php
    }
}
?>
					
				</div>
			</div>
		</div>
		<!-- end s-content__media -->

		<div class="col-full s-content__main">

			<p class="lead"><?= $model->content?></p>

			<p><?= $model->content?></p>

		</div>
	</article>
</section>
<!-- s-content -->