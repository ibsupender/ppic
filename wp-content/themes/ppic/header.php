<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_LMS
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="mobile-nav" class="sidenav">
    <a id="mobile-close" href="#">&times;</a>
	<?php
	wp_nav_menu( array(
		'theme_location' => 'menu-1',
		'menu_id'        => 'primary-menu'
	) );
	?>
</div>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-lms' ); ?></a>

	<header id="masthead" class="site-header">
        <?php
        $show_topbar = esc_attr( get_theme_mod('show_topbar', '1') );
        $show_login = esc_attr( get_theme_mod('show_login', '1') );
        $show_register = esc_attr( get_theme_mod('show_register', '1') );
        $show_logout = esc_attr( get_theme_mod('show_logout', '1') );
        if ( $show_topbar != 1 ) {
        ?>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 text-left">
		                <?php if ( is_active_sidebar( 'topbar-left' ) ) : dynamic_sidebar('topbar-left'); endif; ?>
                    </div>
                    <div class="col-sm-6 text-right hidden-xs">
		                <?php if ( is_active_sidebar( 'topbar-right' ) ) : dynamic_sidebar('topbar-right'); endif; ?>
                        <div class="header_login_url">
                            <?php if ( !is_user_logged_in() ) { ?>
                            <?php if( $show_login != 1 ) { ?>
                            <a href="<?php echo esc_url( get_theme_mod('login_url') ) ?>"><i class="fa fa-user"></i><?php echo esc_html__('Login', 'education-lms') ?>	</a>
                            <span class="vertical_divider"></span>
                            <?php } ?>
	                        <?php if( $show_register != 1 ) { ?>
                                    <a href="<?php echo esc_url( get_theme_mod('register_url') ) ?>"><?php echo esc_html__('Register', 'education-lms') ?></a>
	                        <?php } ?>
                            <?php } else {
                                if( $show_logout != 1 ) {
                                    echo '<a href="' . esc_url( wp_logout_url( home_url() ) ) . '">' . esc_html__( 'Logout', 'education-lms' ) . ' <i class="fa fa-sign-out"></i> </a>';
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

		<div class="header-default">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="site-branding">

                            <div class="site-logo">
	                            <?php  the_custom_logo(); ?>
                            </div>

                         

                        </div><!-- .site-branding -->
                    </div>

                    <div class="col-lg-8 pull-right">
                        <a href="#" id="mobile-open"><i class="fa fa-bars"></i></a>
                        <nav id="site-navigation" class="main-navigation">
		                    <?php
		                    wp_nav_menu( array(
			                    'theme_location' => 'menu-1',
			                    'menu_id'        => 'primary-menu',
                                'menu_class'     => 'pull-right'
		                    ) );
		                    ?>
                        </nav><!-- #site-navigation -->
                    </div>
                </div>
            </div>
        </div>
	</header><!-- #masthead -->

    <?php do_action('education_lms_header_titlebar') ; ?>

	<div id="content" class="site-content">