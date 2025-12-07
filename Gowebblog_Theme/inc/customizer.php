<?php
/**
 * Customizer additions
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add postMessage support for select and textarea controls
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function gowebblog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'gowebblog_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'gowebblog_customize_partial_blogdescription',
			)
		);
	}

	// Add theme color settings section.
	$wp_customize->add_section(
		'gowebblog_colors',
		array(
			'title'    => __( 'Theme Colors', 'gowebblog' ),
			'priority' => 30,
		)
	);

	// Add color settings.
	$colors = array(
		'primary_color'   => array(
			'label'   => __( 'Primary Color', 'gowebblog' ),
			'default' => '#ffffff',
		),
		'secondary_color' => array(
			'label'   => __( 'Secondary Color', 'gowebblog' ),
			'default' => '#999999',
		),
		'accent_color'    => array(
			'label'   => __( 'Accent Color', 'gowebblog' ),
			'default' => '#d1d5db',
		),
		'dark_color'      => array(
			'label'   => __( 'Dark Color', 'gowebblog' ),
			'default' => '#121212',
		),
		'darker_color'    => array(
			'label'   => __( 'Darker Color', 'gowebblog' ),
			'default' => '#0a0a0a',
		),
		'card_color'      => array(
			'label'   => __( 'Card Color', 'gowebblog' ),
			'default' => '#1c1c1c',
		),
	);

	foreach ( $colors as $key => $color ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $color['default'],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$key,
				array(
					'label'   => $color['label'],
					'section' => 'gowebblog_colors',
					'settings' => $key,
				)
			)
		);
	}

	// Add layout options section.
	$wp_customize->add_section(
		'gowebblog_layout',
		array(
			'title'    => __( 'Layout Options', 'gowebblog' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'gowebblog_sidebar_position',
		array(
			'default'           => 'right',
			'sanitize_callback' => 'gowebblog_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'gowebblog_sidebar_position',
		array(
			'label'   => __( 'Sidebar Position', 'gowebblog' ),
			'section' => 'gowebblog_layout',
			'type'    => 'select',
			'choices' => array(
				'left'  => __( 'Left', 'gowebblog' ),
				'right' => __( 'Right', 'gowebblog' ),
				'none'  => __( 'None (Full Width)', 'gowebblog' ),
			),
		)
	);

	$wp_customize->add_setting(
		'gowebblog_excerpt_length',
		array(
			'default'           => 30,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'gowebblog_excerpt_length',
		array(
			'label'       => __( 'Excerpt Length', 'gowebblog' ),
			'description' => __( 'Number of words to show in post excerpts.', 'gowebblog' ),
			'section'     => 'gowebblog_layout',
			'type'        => 'number',
			'input_attrs'  => array(
				'min'  => 10,
				'max'  => 100,
				'step'  => 5,
			),
		)
	);

	// Add header options section.
	$wp_customize->add_section(
		'gowebblog_header',
		array(
			'title'    => __( 'Header Options', 'gowebblog' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'gowebblog_show_tagline',
		array(
			'default'           => true,
			'sanitize_callback' => 'gowebblog_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_show_tagline',
		array(
			'label'   => __( 'Show Tagline', 'gowebblog' ),
			'section' => 'gowebblog_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'gowebblog_cta_text',
		array(
			'default'           => __( "Let's Talk", 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_cta_text',
		array(
			'label'   => __( 'CTA Button Text', 'gowebblog' ),
			'section' => 'gowebblog_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'gowebblog_cta_link',
		array(
			'default'           => '#contact',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_cta_link',
		array(
			'label'   => __( 'CTA Button Link', 'gowebblog' ),
			'section' => 'gowebblog_header',
			'type'    => 'text',
		)
	);

	// Add hero image section.
	$wp_customize->add_section(
		'gowebblog_hero',
		array(
			'title'    => __( 'Hero Section', 'gowebblog' ),
			'priority' => 25,
		)
	);

	// Add hero image setting.
	$wp_customize->add_setting(
		'gowebblog_hero_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'gowebblog_hero_image',
			array(
				'label'       => __( 'Hero Image', 'gowebblog' ),
				'description' => __( 'Upload an image for the hero section. Default image will be used if no image is selected.', 'gowebblog' ),
				'section'     => 'gowebblog_hero',
				'mime_type'   => 'image',
				'button_labels' => array(
					'select'       => __( 'Select Image', 'gowebblog' ),
					'change'       => __( 'Change Image', 'gowebblog' ),
					'default'      => __( 'Default', 'gowebblog' ),
					'remove'       => __( 'Remove', 'gowebblog' ),
					'placeholder'  => __( 'No image selected', 'gowebblog' ),
					'frame_title'  => __( 'Select Image', 'gowebblog' ),
					'frame_button' => __( 'Choose Image', 'gowebblog' ),
				),
			)
		)
	);

	// Add footer options section.
	$wp_customize->add_section(
		'gowebblog_footer',
		array(
			'title'    => __( 'Footer Options', 'gowebblog' ),
			'priority' => 45,
		)
	);

	// Add footer menu setting.
	$wp_customize->add_setting(
		'gowebblog_footer_menu',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);

	// Get all menus to create choices.
	$menus = wp_get_nav_menus();
	$menu_choices = array( 0 => __( 'Select a menu', 'gowebblog' ) );
	foreach ( $menus as $menu ) {
		$menu_choices[ $menu->term_id ] = $menu->name;
	}

	$wp_customize->add_control(
		'gowebblog_footer_menu',
		array(
			'label'       => __( 'Footer Quick Links Menu', 'gowebblog' ),
			'description' => __( 'Select a menu to display as quick links in the footer. If no menu is selected, default quick links will be shown.', 'gowebblog' ),
			'section'     => 'gowebblog_footer',
			'type'        => 'select',
			'choices'     => $menu_choices,
		)
	);
}
add_action( 'customize_register', 'gowebblog_customize_register' );

/**
 * Sanitize select options
 *
 * @param string $input Select option.
 * @param array  $setting Available options.
 * @return string Sanitized option.
 */
function gowebblog_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize checkbox
 *
 * @param bool $input Checkbox value.
 * @return bool Sanitized value.
 */
function gowebblog_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true === $input ) ? true : false );
}

/**
 * Binds JS handlers to make Customizer preview reload changes asynchronously.
 */
function gowebblog_customize_preview_js() {
	wp_enqueue_script(
		'gowebblog-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		'',
		true
	);
}
add_action( 'customize_preview_init', 'gowebblog_customize_preview_js' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gowebblog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gowebblog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}