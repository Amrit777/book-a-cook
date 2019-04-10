<?php
use yii\helpers\Url;
use app\models\Category;
use app\models\Post;
use app\models\User;
use app\models\Menu;
$models = Category::find ()->all ();
$postModels = (new Menu ())->getTypeOptions ();
?>

<ul class="header__nav">
	<li class="current"><a href="<?= Url::toRoute(['/site/index'])?>"
		title="">Home</a></li>
	<li class="has-children"><a href="#0" title="">Categories</a>
		<ul class="sub-menu">
		<?php
		if (! empty ( $models )) {
			foreach ( $models as $model ) {
				echo "<li><a href=" . Url::toRoute ( [ 
						'/category/menu',
						'id' => $model->id 
				] ) . ">" . $model->title . "</a></li>";
			}
		}
		?>
		</ul></li>
	<li class="has-children"><a href="#0" title="">Menu</a>
		<ul class="sub-menu">
		<?php
		
		if (! empty ( $postModels )) {
			
			foreach ( $postModels as $value ) {
				echo "<li><a href=" . Url::toRoute ( [ 
						'/menu/detail',
						'title' => $value 
				] ) . ">" . $value . "</a></li>";
			}
		}
		?>
		</ul></li>
	<?php if (!Yii::$app->user->id){?>
	<li><a href="<?= Url::toRoute(['/user/login'])?>" title="">Login/Register</a></li>
	<?php }else{?>
		<li><a
		href="<?= Url::toRoute(['/user/view','id' => Yii::$app->user->id])?>"
		title=""><?php echo Yii::$app->user->identity->full_name?></a>
		<ul class="sub-user">
			<li><a href="<?php echo Url::toRoute(['user/logout']);?>">Logout</a></li>
		</ul></li>
	
	<?php }?>
</ul>