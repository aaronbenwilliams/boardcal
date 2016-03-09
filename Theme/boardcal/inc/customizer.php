<?php
/**
 * boardcal Theme Customizer
 *
 * @package boardcal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function boardcal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'boardcal_customize_register' );

/**
 * Options for WordPress Theme Customizer.
 */
function boardcal_customizer( $wp_customize ) {

	// logo
	$wp_customize->add_setting( 'header_logo', array(
		'default' => '',
		'transport'   => 'refresh',
                'sanitize_callback' => 'boardcal_sanitize_number'
	) );
        $wp_customize->add_control(new WP_Customize_Media_Control( $wp_customize, 'header_logo', array(
    		'label' => __( 'Logo', 'boardcal' ),
    		'section' => 'title_tagline',
    		'mime_type' => 'image',
    		'priority'  => 10,
    	) ) );


    global $header_show;
    $wp_customize->add_setting('header_show', array(
            'default' => 'logo-text',
            'sanitize_callback' => 'boardcal_sanitize_radio_header'
        ));
        $wp_customize->add_control('header_show', array(
            'type' => 'radio',
            'label' => __('Show', 'boardcal'),
            'section' => 'title_tagline',
            'choices' => $header_show
        ));

        /* Main option Settings Panel */
    $wp_customize->add_panel('boardcal_main_options', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('boardcal Options', 'boardcal'),
        'description' => __('Panel to update boardcal theme options', 'boardcal'), // Include html tags such as <p>.
        'priority' => 10 // Mixed with top-level-section hierarchy.
    ));

	// add "Content Options" section
	$wp_customize->add_section( 'boardcal_content_section' , array(
		'title'      => esc_html__( 'Content Options', 'boardcal' ),
		'priority'   => 50,
                'panel' => 'boardcal_main_options'
	) );

	// add setting for excerpts/full posts toggle
	$wp_customize->add_setting( 'boardcal_excerpts', array(
		'default'           => 1,
		'sanitize_callback' => 'boardcal_sanitize_checkbox',
	) );

	// add checkbox control for excerpts/full posts toggle
	$wp_customize->add_control( 'boardcal_excerpts', array(
		'label'     => esc_html__( 'Show post excerpts?', 'boardcal' ),
		'section'   => 'boardcal_content_section',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'boardcal_page_comments', array(
		'default' => 1,
		'sanitize_callback' => 'boardcal_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'boardcal_page_comments', array(
		'label'		=> esc_html__( 'Display Comments on Static Pages?', 'boardcal' ),
		'section'	=> 'boardcal_content_section',
		'priority'	=> 20,
		'type'      => 'checkbox',
	) );


	// add "Featured Posts" section
	$wp_customize->add_section( 'boardcal_featured_section' , array(
		'title'      => esc_html__( 'Slider Option', 'boardcal' ),
		'priority'   => 60,
                'panel' => 'boardcal_main_options'
	) );

	$wp_customize->add_setting( 'boardcal_featured_cat', array(
		'default' => 0,
		'transport'   => 'refresh',
                'sanitize_callback' => 'boardcal_sanitize_slidecat'
	) );

	$wp_customize->add_control( 'boardcal_featured_cat', array(
		'type' => 'select',
		'label' => 'Choose a category',
		'choices' => boardcal_cats(),
		'section' => 'boardcal_featured_section',
	) );

	$wp_customize->add_setting( 'boardcal_featured_hide', array(
		'default' => 0,
		'transport'   => 'refresh',
                'sanitize_callback' => 'boardcal_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'boardcal_featured_hide', array(
		'type' => 'checkbox',
		'label' => 'Show Slider',
		'section' => 'boardcal_featured_section',
	) );


	// add "Sidebar" section
        $wp_customize->add_section('boardcal_layout_section', array(
            'title' => __('Layout options', 'boardcal'),
            'priority' => 31,
            'panel' => 'boardcal_main_options'
        ));
            // Layout options
            global $site_layout;
            $wp_customize->add_setting('boardcal_sidebar_position', array(
                 'default' => 'side-right',
                 'sanitize_callback' => 'boardcal_sanitize_layout'
            ));
            $wp_customize->add_control('boardcal_sidebar_position', array(
                 'label' => __('Website Layout Options', 'boardcal'),
                 'section' => 'boardcal_layout_section',
                 'type'    => 'select',
                 'description' => __('Choose between different layout options to be used as default', 'boardcal'),
                 'choices'    => $site_layout
            ));

            $wp_customize->add_setting('accent_color', array(
                    'default' => '',
                    'sanitize_callback' => 'boardcal_sanitize_hexcolor'
                ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
                'label' => __('Accent Color', 'boardcal'),
                'description'   => __('Default used if no color is selected','boardcal'),
                'section' => 'boardcal_layout_section',
            )));

            $wp_customize->add_setting('social_color', array(
                'default' => '',
                'sanitize_callback' => 'boardcal_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'social_color', array(
                'label' => __('Social icon color', 'boardcal'),
                'description' => sprintf(__('Default used if no color is selected', 'boardcal')),
                'section' => 'boardcal_layout_section',
            )));

            $wp_customize->add_setting('social_hover_color', array(
                'default' => '',
                'sanitize_callback' => 'boardcal_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'social_hover_color', array(
                'label' => __('Social Icon:hover Color', 'boardcal'),
                'description' => sprintf(__('Default used if no color is selected', 'boardcal')),
                'section' => 'boardcal_layout_section',
            )));

	// add "Footer" section
	$wp_customize->add_section( 'boardcal_footer_section' , array(
		'title'      => esc_html__( 'Footer', 'boardcal' ),
		'priority'   => 90,
	) );

	$wp_customize->add_setting( 'boardcal_footer_copyright', array(
		'default' => '',
		'transport'   => 'refresh',
                'sanitize_callback' => 'boardcal_sanitize_strip_slashes'
	) );

	$wp_customize->add_control( 'boardcal_footer_copyright', array(
		'type' => 'textarea',
		'label' => 'Copyright Text',
		'section' => 'boardcal_footer_section',
	) );

        /* boardcal Other Options */
        $wp_customize->add_section('boardcal_other_options', array(
            'title' => __('Other', 'boardcal'),
            'priority' => 70,
            'panel' => 'boardcal_main_options'
        ));
            $wp_customize->add_setting('custom_css', array(
                'default' => '',
                'sanitize_callback' => 'boardcal_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('custom_css', array(
                'label' => __('Custom CSS', 'boardcal'),
                'description' => sprintf(__('Additional CSS', 'boardcal')),
                'section' => 'boardcal_other_options',
                'type' => 'textarea'
            ));

}
add_action( 'customize_register', 'boardcal_customizer' );

/**
 * Adds sanitization callback function: Strip Slashes
 * @package boardcal
 */
function boardcal_sanitize_strip_slashes($input) {
    return wp_kses_stripslashes($input);
}

/**
 * Sanitzie checkbox for WordPress customizer
 */
function boardcal_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Adds sanitization callback function: Sidebar Layout
 * @package boardcal
 */
function boardcal_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: colors
 * @package boardcal
 */
function boardcal_sanitize_hexcolor($color) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Slider Category
 * @package boardcal
 */
function boardcal_sanitize_slidecat( $input ) {

    if ( array_key_exists( $input, boardcal_cats()) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Radio Header
 * @package boardcal
 */
function boardcal_sanitize_radio_header( $input ) {
   global $header_show;
    if ( array_key_exists( $input, $header_show ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Number
 * @package boardcal
 */
function boardcal_sanitize_number($input) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function boardcal_customize_preview_js() {
	wp_enqueue_script( 'boardcal_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20160217', true );
}
add_action( 'customize_preview_init', 'boardcal_customize_preview_js' );

/**
 * Add CSS for custom controls
 */
function boardcal_customizer_custom_control_css() {
	?>
    <style>
        #customize-control-boardcal-main_body_typography-size select, #customize-control-boardcal-main_body_typography-face select,#customize-control-boardcal-main_body_typography-style select { width: 60%; }
    </style><?php
}
add_action( 'customize_controls_print_styles', 'boardcal_customizer_custom_control_css' );
