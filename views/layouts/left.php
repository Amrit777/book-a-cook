<?php
use app\models\User;
?>
<aside class="main-sidebar">

	<section class="sidebar">

		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
                <?=\Yii::$app->user->identity->profileImage ( [ "class" => "img-circle","alt" => "User Image" ] )?>
            </div>
			<div class="pull-left info">
				<p><?= \Yii::$app->user->identity->full_name ?></p>
			</div>
		</div>


        <?php
								
								echo dmstr\widgets\Menu::widget ( [ 
										'options' => [ 
												'class' => 'sidebar-menu tree',
												'data-widget' => 'tree' 
										],
										'items' => [ 
												[ 
														'label' => 'Menu',
														'options' => [ 
																'class' => 'header' 
														] 
												],
												[ 
														'label' => 'Users',
														'icon' => 'users',
														'url' => [ 
																'/user' 
														],
														'visible' => User::isAdmin () 
												],
												
												[ 
														'label' => 'Category',
														'icon' => 'picture-o',
														'url' => [ 
																'/category' 
														],
														'visible' => User::isAdmin () 
												],
												[ 
														'label' => 'Menu',
														'icon' => 'picture-o',
														'url' => [ 
																'/menu' 
														] 
												] 
										
										] 
								] )?>

    </section>

</aside>
