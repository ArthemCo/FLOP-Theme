

<article id="post-<?php the_ID(); ?>">
	<?php $bg = false;

	if (has_post_thumbnail( $post->ID ) ): ?>
	  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
	  $bg = true;
	  ?>
	  <div id="page-bg" style="background-image: url('<?php echo $image[0]; ?>')"></div>
	<?php endif; ?>

	<header class="page-header <?php if ($bg) { echo 'has-bg'; } ?>">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php flop_posted_on(); ?>
		</div>
		<?php endif; ?>

	</header>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'flop' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flop' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer class="entry-footer">
		<?php flop_entry_footer(); ?>
	</footer>
</article>
