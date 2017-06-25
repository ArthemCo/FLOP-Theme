<?php
/**
 * flop Theme Customizer
 *
 * @package flop
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flop_customize_register( $wp_customize ) {

	/* Deregister things */
	$wp_customize->remove_panel("widgets");

	/* Panels */
	$wp_customize->add_panel( 'panel_content', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Site Content', 'flop' ),
		'description' => __('This panel controls what the main page will display as the featured story, submission link images and fixed media across the site.', 'flop')
	) );


	// Panel 1: Homepage
	$wp_customize->add_section( 'section_home', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Home Page', 'flop' ),
	    'description' => 'This panel controls the homepage banner. Note that the translation shortcodes, eg: [:en]English Text[:de]Deutsch[:], work in these fields.',
			'panel' => 'panel_content'
	) );

	// Homepage hero image
	$wp_customize->add_setting( 'home_hero_bg' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'home_hero_bg', array(
				'label'    => __( 'Next Meetup Banner', 'flop' ),
				'section'  => 'section_home',
				'settings' => 'home_hero_bg',
				'priority' => 1,
				'description' => 'Must be 2560x1600px, .jpg'
			)
		)
	);

	// Next Theme text
	$wp_customize->add_setting( 'home_hero_theme_text' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'home_hero_theme_text', array(
				'label'    => __( 'Next Theme Text', 'flop' ),
				'section'  => 'section_home',
				'settings' => 'home_hero_theme_text',
				'priority' => 1
			)
		)
	);

	// Call to Action button
	$wp_customize->add_setting( 'home_hero_link' );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'home_hero_link', array(
				'label'     => __('Hero Banner Link', 'flop'),
				'section'   => 'section_home',
				'settings'  => 'home_hero_link',
				'priority'  => 2,
				'type'      => 'text',
				'description'=> __('When users click on the next theme area, take them to this link', 'flop'),
			)
		)
	);

	// Call to Action button text
	$wp_customize->add_setting('home_hero_theme_description');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'home_hero_theme_description', array(
				'label'     => __('Next Theme details', 'flop'),
				'section'   => 'section_home',
				'settings'  => 'home_hero_theme_description',
				'priority'  => 2,
				'description'=> __('Date of the next meetup & details', 'flop'),
			)
		)
	);

	// Added to existing Title tag
	$wp_customize->add_setting( 'flop_header_logo' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_logo', array(
				'label'    => __( 'Header Logo', 'flop' ),
				'section'  => 'title_tagline',
				'settings' => 'flop_header_logo',
			)
		)
	);


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'flop_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flop_customize_preview_js() {
	wp_enqueue_script( 'flop_customizer', get_template_directory_uri() . '/inc/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'flop_customize_preview_js' );
