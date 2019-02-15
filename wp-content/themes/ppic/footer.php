<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_LMS
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

        <div class="footer-connect">
            <div class="container">
                <div class="footer-social">
                    <label><?php echo esc_html( get_theme_mod('Follow Us',  esc_html__('Follow Us', 'education-lms') ) )  ?></label>
                </div>
            </div>
        </div>

		<div class="container">

            <div class="footer-widgets">
                <div class="row">
                    <div class="col-md-4">
			            <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                    <div class="col-md-4">
			            <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                    <div class="col-md-4">
			            <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                </div>
            </div>

        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
