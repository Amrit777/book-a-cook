<?php ?>

<article class="col-block popular__post">
	<a href="#0" class="popular__thumb">	
	<?= $model->getImageFile($model, 'thumbs/small/beetle-150.jpg', [], true, $model->title)?>
	</a>
	<h5>
		<a href="#0"><?php echo $model->title?></a>
	</h5>
	<section class="popular__meta">
		<span class="popular__author"><span>By</span> <a href="#0"> <?php echo $model->createUser->full_name?></a></span>
		<span class="popular__date"><span>on</span> <?php echo $model->created_on?></span>
	</section>
</article>

