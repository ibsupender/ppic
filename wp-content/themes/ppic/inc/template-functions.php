<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Education_LMS
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function education_lms_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}


	$post_layout = esc_attr( get_theme_mod('post_layout', 'right-sidebar') );
	$classes[] = $post_layout;

	return $classes;
}
add_filter( 'body_class', 'education_lms_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function education_lms_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'education_lms_pingback_header' );


function education_lms_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <label for="s">
    	<input type="text" value="' . get_search_query() . '" placeholder="' . esc_attr__( 'Search &hellip;', 'education-lms' ) . '" name="s" id="s" />
    </label>
    <button type="submit" class="search-submit">
        <i class="fa fa-search"></i>
    </button>
    </form>';
	return $form;
}
add_filter( 'get_search_form', 'education_lms_search_form' );

function education_lms_titlebar() {
    global $post;
	$blog_title =  get_theme_mod('blog_page_title', 'Blog') ;
    $course_page = absint( education_lms_get_setting('courses_page_id') );

	if ( !is_front_page() ) {
		?>
        <div class="titlebar">
            <div class="container">

				<?php
				if ( is_home() || is_singular('post') ) {
					echo '<h2 class="header-title">' . esc_html( $blog_title ) . '</h2>';
				}  elseif ( $course_page == $post->ID ) {
					the_title( '<h1 class="header-title">', '</h1>' );
                } elseif ( is_archive() ) {
					the_archive_title( '<h1 class="header-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				}
				else the_title( '<h1 class="header-title">', '</h1>' )
				?>
                <div class="triangled_colored_separator"></div>
            </div>
        </div>
		<?php

		education_lms_breadcrumb();
    }
}
add_action('education_lms_header_titlebar', 'education_lms_titlebar');

/* Custom style */
function education_lms_custom_style(){
	$custom_css = '';

	$primary_color   = esc_attr( get_theme_mod( 'primary_color', '#ffb606' ) );


	$titlebar_bg   = esc_attr( get_theme_mod( 'titlbar_bg_color', '#457992' ) );
	$titlebar_pd_top = absint( get_theme_mod( 'padding_top', 5 ) );
	$titlebar_pd_bottom = absint( get_theme_mod( 'padding_botton', 5 ) );

	$custom_css .= "
	        button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"],
	        .readmore a,
		    .titlebar .triangled_colored_separator,
		    .widget-area .widget-title::after,
		    .carousel-wrapper h2.title::after,
		    .course-item .course-thumbnail .price,
		    .site-footer .footer-social,
		    .single-lp_course .lp-single-course ul.learn-press-nav-tabs .course-nav.active, 
		    .single-lp_course .lp-single-course ul.learn-press-nav-tabs .course-nav:hover
		     { background: $primary_color; }
		  
            a:hover, a:focus, a:active,
            .main-navigation a:hover,
            .entry-title a:hover,
            .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation .current-menu-ancestor > a,
            .entry-meta span i,
            .site-footer a:hover,
            .blog .entry-header .entry-date, .archive .entry-header .entry-date,
            .site-footer .copyright-area span,
            .breadcrumbs a:hover span,
            .carousel-wrapper .slick-arrow:hover:before,
            .recent-post-carousel .post-item .btn-readmore:hover,
            .recent-post-carousel .post-item .recent-news-meta span i,
            .recent-post-carousel .post-item .entry-title a:hover,
            .single-lp_course .course-info li i,
            .search-form .search-submit
            {
                color: $primary_color;
            }
		       
		     .recent-post-carousel .post-item .btn-readmore:hover,
		    .carousel-wrapper .slick-arrow:hover,
		    .single-lp_course .lp-single-course .course-curriculum ul.curriculum-sections .section-header,
            .readmore a:hover {
                border-color: $primary_color;
            }
		 
	";

	if ( has_header_image() ) {
		$header_image = get_header_image();
		$custom_css .= "
		 .titlebar { background-image: url($header_image); background-repeat: no-repeat; background-size: cover; background-position: center center;  }
	";
	}

	$custom_css .= "
		 .titlebar { background-color: $titlebar_bg; padding-top: $titlebar_pd_top%; padding-bottom: $titlebar_pd_bottom%; }
	";

	return $custom_css;
}


if ( !is_admin() ) {
	function education_lms_custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'education_lms_custom_excerpt_length', 999 );
	function education_lms_excerpt_more( $more ) {
		return '&hellip;';
	}
	add_filter( 'excerpt_more', 'education_lms_excerpt_more' );

}

if ( is_admin() ) {
	function education_lms_remove_learnpress_ads() {
		?>
        <style>
            #learn-press-advertisement { display: none; }
        </style>
        <?php
	}
	add_action( 'admin_footer', 'education_lms_remove_learnpress_ads', 100 );

}


add_action( 'tgmpa_register', 'education_lms_register_required_plugins' );
function education_lms_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => false,
		),

		array(
			'name'      => 'LearnPress - WordPress LMS Plugin',
			'slug'      => 'learnpress',
			'required'  => false,
		),

		array(
			'name'      => 'LearnPress - Course Review',
			'slug'      => 'learnpress-course-review',
			'required'  => false,
		),

		array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),


	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'education-lms',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


	);

	tgmpa( $plugins, $config );
}

function education_lms_ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => 'Education LMS Demo Import',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/dummy-data/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/dummy-data/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/dummy-data/customizer.dat'
		)
	);
}
add_filter( 'pt-ocdi/import_files', 'education_lms_ocdi_import_files' );

function education_lms_footer_info() {
	echo sprintf( esc_html__( 'Copyright &copy; %1$s %2$s - %3$s theme by %4$s', 'education-lms' ), date_i18n( __('Y', 'education-lms') ), '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'.esc_html( get_bloginfo( 'name', 'display' ) ).'</a>', '<a target="_blank" href="https://www.filathemes.com/download/education-lms">Education LMS</a>', '<span>FilaThemes</span>' );
}
add_action( 'education_lms_footer_copyright', 'education_lms_footer_info' );