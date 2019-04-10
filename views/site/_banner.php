<?php
$list = [];
$data = [];
if (! empty($bannerModel)) {
    foreach ($bannerModel as $key => $value) {
        $list['title'] = $value->title;
        $list['id'] = $value->id;
        $list['category'] = $value->category->title;
//         $list['file'] = $value->getImageFile($value, null, [], false, $value->title, false);
        $list['created_by'] = $value->getCreatedUser();
        $list['post_date'] = $value->created_on;
        $data[$key][] = $list;
    }
}

?>
<div class="pageheader-content row ">
	<div class="col-full">

		<div class="featured">

			<div class="featured__column featured__column--big">
				<div class="entry"
					style="background-image: url('<?= $data[0][0]["file"]?>');">


					<div class="entry__content">
						<span class="entry__category"><a href="#0">Music</a></span>

						<h1>
							<a href="#0" title="">What Your Music Preference Says About You
								and Your Personality.</a>
						</h1>

						<div class="entry__info">
							<a href="#0" class="entry__profile-pic"> <img class="avatar"
								src="<?php echo Yii::$app->view->theme->getUrl("img/avatars/user-03.jpg")?>"
								alt="">
							</a>

							<ul class="entry__meta">
								<li><a href="#0">John Doe</a></li>
								<li>December 29, 2017</li>
							</ul>
						</div>
					</div>
					<!-- end entry__content -->

				</div>
				<!-- end entry -->
			</div>
			<!-- end featured__big -->

			<div class="featured__column featured__column--small">

				<div class="entry"
						style="background-image: url('<?= \Yii::$app->view->theme->getUrl('img/thumbs/featured/featured-watch.jpg')?>');">

					<div class="entry__content">
						<span class="entry__category"><a href="#0">Management</a></span>

						<h1>
							<a href="#0" title="">The Pomodoro Technique Really Works.</a>
						</h1>

						<div class="entry__info">
							<a href="#0" class="entry__profile-pic"> <img class="avatar"
								src="<?php echo Yii::$app->view->theme->getUrl("img/avatars/user-03.jpg")?>"
								alt="">
							</a>

							<ul class="entry__meta">
								<li><a href="#0">John Doe</a></li>
								<li>December 27, 2017</li>
							</ul>
						</div>
					</div>
					<!-- end entry__content -->

				</div>
				<!-- end entry -->

				<div class="entry"
						style="background-image: url('<?= \Yii::$app->view->theme->getUrl('img/thumbs/featured/featured-beetle.jpg') ?>');">

					<div class="entry__content">
						<span class="entry__category"><a href="#0">LifeStyle</a></span>

						<h1>
							<a href="#0" title="">Throwback To The Good Old Days.</a>
						</h1>

						<div class="entry__info">
							<a href="#0" class="entry__profile-pic"> <img class="avatar"
								src="<?php echo Yii::$app->view->theme->getUrl("img/avatars/user-03.jpg")?>"
								alt="">
							</a>

							<ul class="entry__meta">
								<li><a href="#0">John Doe</a></li>
								<li>December 21, 2017</li>
							</ul>
						</div>
					</div>
					<!-- end entry__content -->

				</div>
				<!-- end entry -->

			</div>
			<!-- end featured__small -->
		</div>
		<!-- end featured -->

	</div>
	<!-- end col-full -->
</div>