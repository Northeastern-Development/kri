<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>
		<meta name="title" content="<?php wp_title(''); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta name="author" content="Northeastern University, http://www.northeastern.edu" />
		<meta name="copyright" content="<?=date("Y")?>" />
		<meta name="language" content="english" />
		<meta name="zipcode" content="02115" />
		<meta name="city" content="Boston" />
		<meta name="state" content="MA" />

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="revisit" content="15 days" />
		<meta http-equiv="robots" content="all" />

		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/favicon/manifest.json">
		<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/7862092/6820572/css/fonts.css" />
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font-awesome.min.css">


		<?php wp_head(); ?>

		<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/scripts.js'></script>

	</head>
	<body <?php body_class(); ?>>

		<!-- <p class="testp" style="position:fixed;background:#000;color:#fff;top:100px;left:0;font-weight:bold;font-size:20px;z-index:99999999;"></p> -->

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header role="banner">
				<div id="secondarynav">
					<?php wp_nav_menu( array( 'theme_location' => 'extra-menu' ) ); ?>
				</div>
				<div id="searchnav">
					<?php get_search_form(); ?>
				</div>

				<!-- logo -->
				<div id="logo">
					<a href="<?=home_url()?>" title="Northeastern Magazine">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="northeastern magazine logo">
					</a>
				</div>
				<!-- /logo -->

				<!-- nav -->
				<nav role="navigation" class="menu">
					<?php nudev_nav(); ?>
				</nav>
				<!-- /nav -->

			</header>
			<!-- /header -->
