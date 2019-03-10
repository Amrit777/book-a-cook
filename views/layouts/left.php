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
        
        echo dmstr\widgets\Menu::widget([
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
                    ]
                ],
                [
                    'label' => 'labels',
                    'icon' => 'users',
                    'url' => [
                        '/main-header'
                    ]
                ],
                [
                    'label' => 'sub-labels',
                    'icon' => 'users',
                    'url' => [
                        '/sub-header'
                    ]
                ],
                [
                    'label' => 'Media',
                    'icon' => 'picture-o',
                    'url' => [
                        '/media/'
                    ]
                ],
                [
                    'label' => 'Banner',
                    'icon' => 'picture-o',
                    'url' => [
                        '/banner'
                    ]
                ],
                [
                    'label' => 'Category',
                    'icon' => 'picture-o',
                    'url' => [
                        '/category'
                    ]
                ],
                [
                    'label' => 'Post',
                    'icon' => 'picture-o',
                    'url' => [
                        '/post'
                    ]
                ],
                [
                    'label' => \yii::t('app', 'Page'),
                    'icon' => 'first-order',
                    'url' => [
                        '/page'
                    ]
                ]
            
            ]
        ])?>

    </section>

</aside>
