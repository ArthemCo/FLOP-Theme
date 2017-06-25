<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package flop
 */

get_header(); ?>

	<div id="primary" class="content-area <?php if (!empty(get_theme_mod('home_hero_link'))) { echo 'hero-banner'; } ?>">

		<?php if ( is_home() && is_front_page() ) : ?>
			<?php // Link if available
			if (!empty(get_theme_mod('home_hero_link'))): ?>
				<a href="<?php echo esc_url(get_permalink(get_theme_mod('home_hero_link'))); ?>">
			<?php endif; ?>

			<div id="hero" style="background:url('<?php echo get_theme_mod('home_hero_bg');?>') center center no-repeat">

				<div id="hero-text">
					<?php if (get_theme_mod('home_hero_theme_text') != '') : ?>
						<h1><?php _e(get_theme_mod('home_hero_theme_text'));?></h1>
					<?php endif; ?>

					<?php if (!empty(get_theme_mod('home_hero_theme_description'))) : ?>
						<p> <?php _e(get_theme_mod('home_hero_theme_description')); ?> </p>
					<?php endif; ?>
				</div>

			</div>
			<?php if (!empty(get_theme_mod('home_hero_link'))) { echo '</a>'; } ?>
		<?php endif; ?>

		<main id="main" class="site-main home-gallery" role="main">

			<?php
			if ( have_posts() ) :

				$current_month = get_the_time('F');


				echo "<section class='home-gallery-meetup'>";
				echo "<aside class='meetup-details'>" . $current_month . "</aside>";

				
				while ( have_posts() ) : the_post();


					$this_month = get_the_time('F');
					if( $this_month != $current_month ):
						$current_month = $this_month;
						echo "</section><section class='home-gallery-meetup'>"; // close the last section
						echo "<aside class='meetup-details'>" . $current_month . "</aside>";
					endif;

					// output data for the post

					// $month = the_date('M', FALSE);
					

					// if ($month !== $month_check) { 
					// 	echo "</section><section class='home-gallery-meetup'>
					// 					<div class='meetup-details'>" . $month . (string)$num_games . "</div>";
					// 	$num_games = 0;
					// }
					// $month_check = $month;
					// $num_games += 1;


					// $num_games += 1;
					get_template_part( 'template-parts/content', 'home' );

				endwhile;
				echo "</section>";

				the_posts_navigation();

			endif; ?>

		</main>
	</div>

<?php
get_sidebar();
get_footer();
