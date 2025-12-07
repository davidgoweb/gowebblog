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

	// Add hero heading text setting.
	$wp_customize->add_setting(
		'gowebblog_hero_heading',
		array(
			'default'           => __( 'Hello, this is', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_hero_heading',
		array(
			'label'   => __( 'Hero Heading Text', 'gowebblog' ),
			'section' => 'gowebblog_hero',
			'type'    => 'text',
		)
	);

	// Add hero subtitle text setting.
	$wp_customize->add_setting(
		'gowebblog_hero_subtitle',
		array(
			'default'           => __( 'Portal', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_hero_subtitle',
		array(
			'label'   => __( 'Hero Subtitle Text', 'gowebblog' ),
			'section' => 'gowebblog_hero',
			'type'    => 'text',
		)
	);

	// Add hero description text setting.
	$wp_customize->add_setting(
		'gowebblog_hero_description',
		array(
			'default'           => __( 'Tech enthusiast and architecture-minded builder based in Jakarta. I blend market insight with solid technical structure to help brands turn ideas into high-quality, scalable products.', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_hero_description',
		array(
			'label'       => __( 'Hero Description Text', 'gowebblog' ),
			'description' => __( 'Enter the description text for the hero section. If left empty, the site description will be used.', 'gowebblog' ),
			'section'     => 'gowebblog_hero',
			'type'        => 'textarea',
		)
	);

	// Add hero skill tag 1 setting.
	$wp_customize->add_setting(
		'gowebblog_hero_skill_1',
		array(
			'default'           => __( 'Web Development', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_hero_skill_1',
		array(
			'label'   => __( 'Hero Skill Tag 1', 'gowebblog' ),
			'section' => 'gowebblog_hero',
			'type'    => 'text',
		)
	);

	// Add hero skill tag 2 setting.
	$wp_customize->add_setting(
		'gowebblog_hero_skill_2',
		array(
			'default'           => __( 'Open Source', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_hero_skill_2',
		array(
			'label'   => __( 'Hero Skill Tag 2', 'gowebblog' ),
			'section' => 'gowebblog_hero',
			'type'    => 'text',
		)
	);

	// Add hero skill tag 3 setting.
	$wp_customize->add_setting(
		'gowebblog_hero_skill_3',
		array(
			'default'           => __( 'Tech Architecture', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_hero_skill_3',
		array(
			'label'   => __( 'Hero Skill Tag 3', 'gowebblog' ),
			'section' => 'gowebblog_hero',
			'type'    => 'text',
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

	// Add footer brand description setting.
	$wp_customize->add_setting(
		'gowebblog_footer_description',
		array(
			'default'           => __( 'A modern WordPress blog theme for developers and designers', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_footer_description',
		array(
			'label'       => __( 'Footer Brand Description', 'gowebblog' ),
			'description' => __( 'Enter the description text for your brand in the footer.', 'gowebblog' ),
			'section'     => 'gowebblog_footer',
			'type'        => 'textarea',
		)
	);

	// Add toggle to enable/disable footer description.
	$wp_customize->add_setting(
		'gowebblog_show_footer_description',
		array(
			'default'           => true,
			'sanitize_callback' => 'gowebblog_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_show_footer_description',
		array(
			'label'   => __( 'Show Footer Description', 'gowebblog' ),
			'section' => 'gowebblog_footer',
			'type'    => 'checkbox',
		)
	);

	// Add 404 page options section.
	$wp_customize->add_section(
		'gowebblog_404_page',
		array(
			'title'    => __( '404 Page Options', 'gowebblog' ),
			'priority' => 50,
		)
	);

	// 404 page title setting.
	$wp_customize->add_setting(
		'gowebblog_404_title',
		array(
			'default'           => __( 'Oops! Page Not Found', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_404_title',
		array(
			'label'   => __( '404 Page Title', 'gowebblog' ),
			'section' => 'gowebblog_404_page',
			'type'    => 'text',
		)
	);

	// 404 page description setting.
	$wp_customize->add_setting(
		'gowebblog_404_description',
		array(
			'default'           => __( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_404_description',
		array(
			'label'   => __( '404 Page Description', 'gowebblog' ),
			'section' => 'gowebblog_404_page',
			'type'    => 'textarea',
		)
	);

	// "Go Home" button text setting.
	$wp_customize->add_setting(
		'gowebblog_404_go_home_text',
		array(
			'default'           => __( 'Go Home', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_404_go_home_text',
		array(
			'label'   => __( '"Go Home" Button Text', 'gowebblog' ),
			'section' => 'gowebblog_404_page',
			'type'    => 'text',
		)
	);

	// "Browse Blog" button text setting.
	$wp_customize->add_setting(
		'gowebblog_404_browse_blog_text',
		array(
			'default'           => __( 'Browse Blog', 'gowebblog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_404_browse_blog_text',
		array(
			'label'   => __( '"Browse Blog" Button Text', 'gowebblog' ),
			'section' => 'gowebblog_404_page',
			'type'    => 'text',
		)
	);

	// Toggle to enable/disable "Go Home" button.
	$wp_customize->add_setting(
		'gowebblog_404_show_go_home',
		array(
			'default'           => true,
			'sanitize_callback' => 'gowebblog_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_404_show_go_home',
		array(
			'label'   => __( 'Show "Go Home" Button', 'gowebblog' ),
			'section' => 'gowebblog_404_page',
			'type'    => 'checkbox',
		)
	);

	// Toggle to enable/disable "Browse Blog" button.
	$wp_customize->add_setting(
		'gowebblog_404_show_browse_blog',
		array(
			'default'           => true,
			'sanitize_callback' => 'gowebblog_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_404_show_browse_blog',
		array(
			'label'   => __( 'Show "Browse Blog" Button', 'gowebblog' ),
			'section' => 'gowebblog_404_page',
			'type'    => 'checkbox',
		)
	);

	// Toggle to enable/disable search functionality.
	$wp_customize->add_setting(
		'gowebblog_404_show_search',
		array(
			'default'           => true,
			'sanitize_callback' => 'gowebblog_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'gowebblog_404_show_search',
		array(
			'label'   => __( 'Show Search Functionality', 'gowebblog' ),
			'section' => 'gowebblog_404_page',
			'type'    => 'checkbox',
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