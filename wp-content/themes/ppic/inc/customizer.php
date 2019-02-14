<?php
/**
 * Education LMS Theme Customizer
 *
 * @package Education_LMS
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_lms_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'education_lms_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'education_lms_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_panel( 'theme_options' ,
		array(
			'title'       => esc_html__( 'Theme Options', 'education-lms' ),
			'description' => ''
		)
	);

	/* Header Topbar */
	$wp_customize->add_section( 'topbar' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Header Topbar', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'show_topbar', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_topbar',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the header topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'show_login', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_login',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the login on topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);


	$wp_customize->add_setting( 'show_register', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_register',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the register on topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);

	$wp_customize->add_setting( 'show_logout', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_logout',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the logout on topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);

	$wp_customize->add_setting( 'login_url', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => ''
	) );
	$wp_customize->add_control( 'login_url',
		array(
			'type'        => 'text',
			'label'       => esc_html__('Login page URL', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'register_url', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => ''
	) );
	$wp_customize->add_control( 'register_url',
		array(
			'type'        => 'text',
			'label'       => esc_html__('Register page URL', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);

	/* Social */
	$wp_customize->add_section( 'social_media' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Social Media', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'follow_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'Follow Us', 'education-lms' ),
	) );
	$wp_customize->add_control(
		'follow_title',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Follow Text', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'facebook_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'facebook_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Facebook', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'twitter_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'twitter_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Twitter', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'gooogle_plus', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'gooogle_plus',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Google+', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'pinterest_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'pinterest_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Pinterest', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'tumblr_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'tumblr_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Tumblr', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'reddit_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'reddit_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Reddit', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'youtube_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'youtube_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Youtube', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'linkedin_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'linkedin_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Linkedin', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'instagram_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'instagram_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Instagram', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'email_address', array(
		'sanitize_callback' => 'sanitize_email',
		'default' => '',
	) );
	$wp_customize->add_control(
		'email_address',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Email', 'education-lms' ),
			'section'    => 'social_media',
		)
	);

	/* Single post */
	$wp_customize->add_section( 'single_post' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Single Post', 'education-lms' ),
			'priority'     => 15
		)
	);

	$wp_customize->add_setting( 'post_layout', array(
		'sanitize_callback' => 'education_lms_sanitize_select',
		'default'           => 'right-sidebar'
	) );
	$wp_customize->add_control( 'post_layout',
		array(
			'type'        => 'select',
			'label'       => esc_html__('Post Layout', 'education-lms'),
			'section'     => 'single_post',
			'choices' => array(
				'right-sidebar' => esc_html__('Right sidebar', 'education-lms'),
				'left-sidebar' => esc_html__('Left sidebar', 'education-lms'),
				'no-sidebar' => esc_html__('No sidebar', 'education-lms'),
			)
		)
	);
	$wp_customize->add_setting( 'show_category', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_category',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide category after main title?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'show_date', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_date',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide date after main title?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'show_author', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_author',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide author after main title?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);


	$wp_customize->add_setting( 'show_tag', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_tag',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide tagged below entry post?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);

	$wp_customize->add_setting( 'show_sharing', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => ''
	) );
	$wp_customize->add_control( 'show_sharing',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide social share below entry post?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);
	/* Titlebar */
	$wp_customize->add_setting( 'titlbar_bg_color' , array(
		'sanitize_callback'	=> 'sanitize_hex_color',
		'default'     => '#457992',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'titlbar_bg_color', array(
		'label'        => esc_html__( 'Background Color', 'education-lms' ),
		'section'    => 'header_image',
		'settings'   => 'titlbar_bg_color',
	) ) );

	/* Primary colr */
	$wp_customize->add_setting( 'primary_color' , array(
		'sanitize_callback'	=> 'sanitize_hex_color',
		'default'     => '#ffb606',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label'        => esc_html__( 'Primary Color', 'education-lms' ),
		'section'    => 'colors',
		'settings'   => 'primary_color',
	) ) );

	$wp_customize->add_panel( 'theme_options' ,
		array(
			'title'       => esc_html__( 'Theme Options', 'education-lms' ),
			'description' => ''
		)
	);
	$wp_customize->add_section( 'titlebar' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Titlebar', 'education-lms' ),

			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'blog_page_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'Blog', 'education-lms' ),
	) );
	$wp_customize->add_control(
		'blog_page_title',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Blog Page Title', 'education-lms' ),
			'description' => esc_html__( 'The title display on blog page.', 'education-lms' ),
			'section'    => 'titlebar',
		)
	);
	$wp_customize->add_setting( 'padding_top', array(
		'sanitize_callback' => 'education_lms_sanitize_number_absint',
		'default' => 5,
	) );
	$wp_customize->add_control(
		'padding_top',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Padding Top', 'education-lms' ),
			'description' => esc_attr__('The page cover padding top in percent (%).', 'education-lms'),
			'section'    => 'titlebar',
		)
	);
	$wp_customize->add_setting( 'padding_botton', array(
		'sanitize_callback' => 'education_lms_sanitize_number_absint',
		'default' => 5,
	) );
	$wp_customize->add_control(
		'padding_botton',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Padding Bottom', 'education-lms' ),
			'description' => esc_attr__('The page cover padding bottom in percent (%).', 'education-lms'),
			'section'    => 'titlebar',
		)
	);




	function education_lms_checkbox_sanitize( $input ){
		//returns true if checkbox is checked
		return ( ( $input == 1 ) ? 1 : '' );
	}
	function education_lms_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );
		// If the input is an absolute integer, return it; otherwise, return the default
		return ( $number ? $number : $setting->default );
	}
	function education_lms_sanitize_select( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}


}
add_action( 'customize_register', 'education_lms_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function education_lms_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function education_lms_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function education_lms_customize_preview_js() {
	wp_enqueue_script( 'education-lms-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'education_lms_customize_preview_js' );

/**
 * Load customizer css
 */
function education_lms_customizer_load_css(){
	wp_enqueue_style( 'education-lms-customizer', get_template_directory_uri() . '/assets/css/customizer.css' );
}
add_action('customize_controls_print_styles', 'education_lms_customizer_load_css');