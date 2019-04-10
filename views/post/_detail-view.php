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

if (! empty ( $model->file )) {
	?>
        <div class="slider__slide">
        <?php
	echo $model->displayImage ( $model->file, $default = 'default.jpg', $options = [ 
			'sizes' => "(max-width: 2000px) 100vw, 2000px",
			'alt' => "Image" 
	] );
	?>
        </div>
        <?php
}
?>
					
				</div>
			</div>
		</div>
		<!-- end s-content__media -->

		<div class="col-full s-content__main">

			<p class="lead">Menu Description: <?= $model->content?></p>

			<p>Price: <?= $model->price?></p>
			<p>Preparation Time: <?= $model->time_to_prepare?></p>
			<p>Cooked by: <?= $model->createUser->full_name?></p>
			<p>Cook contact: <?= $model->createUser->contact_no?></p>
			



		</div>
	</article>
</section>
<!-- s-content -->