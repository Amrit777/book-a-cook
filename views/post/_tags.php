<?php
use app\models\Category;
use yii\helpers\Url;
$tagModel = Category::find()->limit(10)->all();
?>
<div class="row bottom tags-wrap">
	<div class="col-full tags">
		<h3>Tags</h3>
		<div class="tagcloud">
		<?php
if (! empty($tagModel)) {
    foreach ($tagModel as $tags) {
        $url = Url::toRoute([
            "post/tags/" . $tags->title
        ]);
        echo "<a href='$url'>$tags->title</a>";
    }
}
?>			
		</div>
		<!-- end tagcloud -->
	</div>
	<!-- end tags -->
</div>