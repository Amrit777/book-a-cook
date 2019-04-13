<?php
use yii\helpers\Html;
use app\widgets\Alert;
use yii2mod\alert\AlertAsset;
?>
<?php $this->beginPage() ?>


<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

<!--- basic page needs
    ================================================== -->
<meta charset="utf-8">
<title>Book Your Cook</title>

<!-- mobile specific metas
    ================================================== -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
	        <?= Html::csrfMetaTags() ?>
<!-- CSS
    ================================================== -->

<link type="text/css" rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css/base.css') ?>" />
<link type="text/css" rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css/vendor.css') ?>" />
<link type="text/css" rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css/main.css') ?>" />
<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js/modernizr.js') ?>"></script>
<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js/pace.min.js') ?>"></script>

<!-- favicons
    ================================================== -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <?php $this->beginBody() ?>

	<!-- pageheader
    ================================================== -->
	<div class="s-pageheader">

		<header class="header">
			<div class="header__content row">

				<div class="header__logo">
					<!-- 					<h4 > -->
					<a class="logo" href="<?php echo Yii::$app->homeUrl?>"> Book Your
						Cook</a>
					<!-- 						</hr> -->

				</div>
				<!-- end header__logo -->
				<a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

				<nav class="header__nav-wrap">
					<?= Yii::$app->controller->renderPartial('/site/_nav-bar')?>
				</nav>
				<!-- end header__nav-wrap -->

			</div>
			<!-- header-content -->
		</header>
		<!-- header -->



		<!-- end pageheader-content row -->

	</div>
	<!-- end s-pageheader -->


	<!-- s-content
    ================================================== -->
<?=\yii2mod\alert\Alert::widget ( );?>
           

	<?=$content;?>
	<!-- s-extra
    ================================================== -->
	<section class="s-extra">

		<div class="row top">
			<!-- end popular -->

			<div class="col-four md-six tab-full about">
				<h3>About Book Your Cook</h3>

				<p>Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero
					malesuada feugiat. Pellentesque in ipsum id orci porta dapibus.
					Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
					posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
					vel, ullamcorper sit amet ligula. Quisque velit nisi, pretium ut
					lacinia in, elementum id enim. Donec sollicitudin molestie
					malesuada.</p>

				<ul class="about__social">
					<li><a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					</li>
					<li><a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					</li>
					<li><a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
					</li>
					<li><a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
					</li>
				</ul>
				<!-- end header__social -->
			</div>
			<!-- end about -->

		</div>
		<!-- end row -->

					<?= Yii::$app->controller->renderPartial('/post/_tags')?>

		<!-- end tags-wrap -->

	</section>
	<!-- end s-extra -->


	<!-- s-footer
    ================================================== -->
	<footer class="s-footer">

		<div class="s-footer__main">
			<div class="row">

				<div class="col-two md-four mob-full s-footer__sitelinks">

					<h4>Quick Links</h4>

					<ul class="s-footer__linklist">
						<li><a href="#0">Home</a></li>
						<li><a href="#0">Blog</a></li>
						<li><a href="#0">Styles</a></li>
						<li><a href="#0">About</a></li>
						<li><a href="#0">Contact</a></li>
						<li><a href="#0">Privacy Policy</a></li>
					</ul>

				</div>
				<!-- end s-footer__sitelinks -->

				<div class="col-two md-four mob-full s-footer__archives">

					<h4>Archives</h4>

					<ul class="s-footer__linklist">
						<li><a href="#0">January 2018</a></li>
						<li><a href="#0">December 2017</a></li>
						<li><a href="#0">November 2017</a></li>
						<li><a href="#0">October 2017</a></li>
						<li><a href="#0">September 2017</a></li>
						<li><a href="#0">August 2017</a></li>
					</ul>

				</div>
				<!-- end s-footer__archives -->

				<div class="col-two md-four mob-full s-footer__social">

					<h4>Social</h4>

					<ul class="s-footer__linklist">
						<li><a href="#0">Facebook</a></li>
						<li><a href="#0">Instagram</a></li>
						<li><a href="#0">Twitter</a></li>
						<li><a href="#0">Pinterest</a></li>
						<li><a href="#0">Google+</a></li>
						<li><a href="#0">LinkedIn</a></li>
					</ul>

				</div>
				<!-- end s-footer__social -->

				<div class="col-five md-full end s-footer__subscribe">

					<h4>Our Newsletter</h4>

					<p>Sit vel delectus amet officiis repudiandae est voluptatem.
						Tempora maxime provident nisi et fuga et enim exercitationem
						ipsam. Culpa consequatur occaecati.</p>

					<div class="subscribe-form">
						<form id="mc-form" class="group" novalidate="true">

							<input type="email" value="" name="EMAIL" class="email"
								id="mc-email" placeholder="Email Address" required=""> <input
								type="submit" name="subscribe" value="Send"> <label
								for="mc-email" class="subscribe-message"></label>

						</form>
					</div>

				</div>
				<!-- end s-footer__subscribe -->

			</div>
		</div>
		<!-- end s-footer__main -->

		<div class="s-footer__bottom">
			<div class="row">
				<div class="col-full">
					<div class="s-footer__copyright">
						<span>© Copyright Gursahib Brar 2019</span>
					</div>
					<div class="go-top">
						<a class="smoothscroll" title="Back to Top" href="#top"></a>
					</div>
				</div>
			</div>
		</div>
		<!-- end s-footer__bottom -->

	</footer>
	<!-- end s-footer -->


	<!-- preloader
    ================================================== -->
	<div id="preloader">
		<div id="loader">
			<div class="line-scale">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>


	<!-- Java Script
    ================================================== -->
	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js/jquery-3.2.1.min.js') ?>"></script>
	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js/plugins.js') ?>"></script>
	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js/main.js') ?>"></script>

    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>