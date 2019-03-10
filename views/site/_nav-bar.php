<?php
use yii\helpers\Url;
use app\models\Category;
use app\models\Post;
$models = Category::find()->all();
$postModels = (new Post())->getTypeOptions();
?>

<ul class="header__nav">
	<li class="current"><a href="<?= Url::toRoute(['/site/index'])?>"
		title="">Home</a></li>
	<li class="has-children"><a href="#0" title="">Categories</a>
		<ul class="sub-menu">
		<?php
if (! empty($models)) {
    foreach ($models as $model) {
        echo "<li><a href=" . Url::toRoute([
            '/category/post',
            'id' => $model->id
        ]) . ">" . $model->title . "</a></li>";
    }
}
?>
		</ul></li>
	<li class="has-children"><a href="#0" title="">Blog</a>
		<ul class="sub-menu">
		<?php

if (! empty($postModels)) {
    
    foreach ($postModels as $key => $value) {
        echo "<li><a href=" . Url::toRoute([
            '/post/type',
            'type' => $key
        ]) . ">" . $value . "</a></li>";
    }
}
?>
		</ul></li>
	<li><a href="<?= Url::toRoute(['/site/about'])?>" title="">About</a></li>
	<li><a href="<?= Url::toRoute(['/site/contact'])?>" title="">Contact</a></li>
</ul>