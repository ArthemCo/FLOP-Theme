<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#000000">

	<?php wp_head(); ?>
	<link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">
</head>

<body <?php body_class(); ?>>

<div class="site-border"></div>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'flop' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">
			<?php if (!empty(get_theme_mod( 'flop_header_logo' ))) : // draw the logo ?>
				
				<a href="<?php echo home_url(); ?>" class="site-logo">
					<img src="<?php echo get_theme_mod( 'flop_header_logo');?>" alt="logo" class="site-logo-img">
				</a>

			<?php else: ?>

				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>

			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php get_template_part('template-parts/nav'); ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
	
