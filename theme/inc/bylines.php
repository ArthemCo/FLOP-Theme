<?php
/*
 * Author: Matt Dulin
 * Author URI: http://mattdulin.com
 * License: GPL2
 */

function flop_add_byline_taxonomy () {
	// Add new "bylines" taxonomy to Posts
	register_taxonomy('byline', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => false,
		'show_admin_column' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x('Bylines', 'taxonomy general name') ,
			'singular_name' => _x('Byline', 'taxonomy singular name') ,
			'search_items' => __('Search Bylines') ,
			'popular_items' => __('Popular Bylines') ,
			'all_items' => __('All Bylines') ,
			'edit_item' => __('Edit Byline') ,
			'update_item' => __('Update Byline') ,
			'separate_items_with_commas' => __('Separate bylines with commas') ,
			'add_new_item' => __('Add New Byline') ,
			'add_or_remove_items' => __('Add or remove bylines') ,
			'choose_from_most_used' => __('Choose from most used bylines') ,
			'new_item_name' => __('New Byline Name') ,
			'menu_name' => __('Bylines')
		) ,
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'byline', // This controls the base slug that will display before each term
			'with_front' => true, // Don't display the category base before "/bylines/"
			'show_tagcloud' => false, // We don't want to make prominent authors *too* prominent.
			'show_ui' => true
			// This will allow URL's like "/bylines/boston/cambridge/"
		) ,
	));
}

// Display the byline by replacing instances of the_author throughout most areas of the site
function byline($name) {
	global $post;
	$author = get_the_term_list($post->ID, 'byline', '', ', ', '');
	if ($author && !is_admin() && !is_feed()) $name = $author;
	return $name;
	if ($author && is_feed()) //Preserves native Wordpress author for feeds
	$name = get_the_author();
	return $name;
}
add_action('init', 'flop_add_byline_taxonomy', 0); // Custom Bylines
add_filter('the_author', 'byline'); // Bylines display
add_filter('get_the_author_display_name', 'byline'); // Bylines setup


/* 
 * This is a modified the_author_posts_link() which just returns the link. 
 * This is necessary to allow usage of the usual l10n process with printf()
 */
function flop_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;

	$link = sprintf( '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'flop' ), get_the_author() ) ), 
		// No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}


if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_bylines',
		'title' => 'Bylines',
		'fields' => array (
			array (
				'key' => 'field_567ca4390c1e8',
				'label' => 'Profile Picture',
				'name' => 'byline_picture',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5682b4d67709c',
				'label' => 'Email',
				'name' => 'byline_email',
				'type' => 'email',
				'instructions' => 'It could be dangerous to add this, never author data without permission. Leave blank to ignore.',
				'default_value' => '',
				'placeholder' => 'example@mail.com',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_5682b5197709d',
				'label' => 'Twitter',
				'name' => 'byline_twitter',
				'type' => 'text',
				'instructions' => 'Leave blank to ignore.',
				'default_value' => '',
				'placeholder' => 'twitterHandle_123',
				'prepend' => '@',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 15,
			),
			array (
				'key' => 'field_5682b5c07709e',
				'label' => 'Facebook',
				'name' => 'byline_facebook',
				'type' => 'text',
				'instructions' => 'The part after "facebook.com/" and before any question marks or ampersands. The flop\'s Facebook group resolves to "groups/482516958582726/" and a random person as "ctkellermann".',
				'default_value' => '',
				'placeholder' => 'groups/groupname or name',
				'prepend' => 'https://www.facebook.com/',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5682b6107709f',
				'label' => 'Website',
				'name' => 'byline_website',
				'type' => 'text',
				'instructions' => 'The author\'s portfolio or other media publisher, not what they endorse. Full URL including "http://".',
				'default_value' => '',
				'placeholder' => 'https://example.com/about.html',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'byline',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'discussion',
				1 => 'comments',
				2 => 'revisions',
				3 => 'featured_image',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}