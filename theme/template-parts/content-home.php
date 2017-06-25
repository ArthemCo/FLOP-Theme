<?php
/**
 * Template part for displaying post fragments in the home loop
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package flop
 */

?>

<?php // determine post type css class

	$post_type = "";
	if (!has_post_thumbnail()) { $post_type = " no-thumbnail"; }
	$post_class = "home-gallery-item" . $post_type;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

	<a href="<?php echo get_post_permalink() ?>" class="entry-link"
		<?php if(has_post_thumbnail()) : ?> style="background-image: url(<?= get_the_post_thumbnail_url(); ?>)" 
		<? endif; ?>
	>
		<div class="entry-details">
			<h2 class="entry-title"><?php the_title() ?></h2>
		</div>

	</a>

</article>
