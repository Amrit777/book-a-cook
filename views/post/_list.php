<?php
use yii\helpers\Url;
$file = $model->fileExists($model, null, null, true);
if ($file['status'] == 'OK') {
    ?>
<article
	class="masonry__brick entry format-standard aos-init aos-animate">

	<div class="entry__thumb">
		<a href="<?php echo Url::toRoute(['posts/'.$model->slug])?>"
			class="entry__thumb-link"> 
			<?php echo $model->getImageFile($model,'default.jpg',[],false, $model->title);?>
		</a>
	</div>

	<div class="entry__text">
		<div class="entry__header">

			<div class="entry__date">
				<?= $model->created_on ?>
			</div>
			<h1 class="entry__title">
				<a href="<?php echo Url::toRoute(['posts/'.$model->slug])?>"
					class="entry__thumb-link"> 
			<?= $model->title ?>
		</a>

			</h1>

		</div>
		<div class="entry__excerpt">
			<p><?= $model->content;?></p>
		</div>
		<blockquote>
			<cite><?= $model->getCreatedUser()?></cite>
		</blockquote>
		<div class="entry__meta">
			<span class="entry__meta-links"> 
			<?= $model->getTags(true,true);?>
			</span>
		</div>
		<div class="entry__meta">
			<span class="entry__meta-links"> <a
				href="<?php echo Url::toRoute(['/post/category/'.$model->category->title]);?>"><?= $model->category->title ?></a>
			</span>
		</div>
	</div>

</article>
<?php
} else {
    ?>
<article class="masonry__brick entry format-quote aos-init aos-animate"
	data-aos="fade-up">
	<div class="entry__thumb">
		<blockquote>
			<p><?= $model->content ?></p>
			<cite><?= $model->getCreatedUser()?></cite> <cite><?= $model->created_on ?></cite>
		</blockquote>
	</div>
</article>
<?php }?>
