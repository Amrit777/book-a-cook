<?php
use yii\widgets\ListView;
?>
<div class="col-eight md-six tab-full popular">
	<h3>Popular Posts</h3>
	<div class="block-1-2 block-m-full popular__posts">
		<?=ListView::widget(['dataProvider' => $dataProvider,'itemView' => '_popular-post','summary' => false,'layout' => "{items}"]);?>	
	</div>
	<!-- end popular_posts -->
</div>