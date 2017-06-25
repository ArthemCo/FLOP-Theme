<?php
/**
 * Remove cruft from the Wordpress interface & code
 *
 * @package flop
 */



/**
 * Remove WordPress logo and menu from admin bar 
 */
function wp_debranding_remove_wp_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'wp_debranding_remove_wp_logo');

/**
 * Remove WordPress related admin dashboard widgets 
 */
function wp_debranding_remove_dashboard_widgets() {
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');  
}
add_action('admin_menu', 'wp_debranding_remove_dashboard_widgets');

/* Remove content generator meta tag from page source */
remove_action('wp_head', 'wp_generator');

/* Remove emoji */
function disable_wp_emoji() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emoji_tinymce' );
}
add_action( 'init', 'disable_wp_emoji' );

function disable_emoji_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

/* Removes width/height attributes from images. */
function remove_thumbnail_dimensions($html) {
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); 
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);  

// Removes ugly .wp-caption classes and wraps captions in neat figcaption elements
function cleaner_caption( $output, $attr, $content ) {
	if ( is_feed() )
		return $output;

	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'caption' => ''
	);

	$attr = shortcode_atts( $defaults, $attr );
	if (empty( $attr['caption'] ) )
		return $content;

	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';

	$output = '<figure' . $attributes .'>';
	$output .= do_shortcode( $content );
	$output .= '<figcaption class="wp-caption-text">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';

	return $output;
}
add_filter('img_caption_shortcode', 'cleaner_caption', 10, 3 );

/* 
 * Removes default link to image file from images.
 */
function attachment_image_link_remove_filter( $content ) { 
    $content = preg_replace( array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}', '{ wp-image-[0-9]*" /></a>}'), array('<img','" />'), $content ); 
    return $content; 
}
add_filter('the_content', 'attachment_image_link_remove_filter' );

