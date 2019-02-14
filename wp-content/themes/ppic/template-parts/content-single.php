<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
$show_date = esc_attr( get_theme_mod('show_date', '1') );
$show_author = esc_attr( get_theme_mod('show_author', '1') );
$show_category = esc_attr( get_theme_mod('show_category', '1') );
$show_tag = esc_attr( get_theme_mod('show_tag', '1') );
$show_sharing = esc_attr( get_theme_mod('show_sharing', '1') );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<div class="entry-meta">
		<?php
		if ( $show_date != 1 )
		    education_lms_posted_on();
		if ( $show_author != 1 )
		    education_lms_posted_by();
		if ( $show_category != 1 )
		    education_lms_posted_in();
		?>
	</div><!-- .entry-meta -->

	<div class="post-featured-image">
		<a href="<?php the_permalink() ?>">
			<?php the_post_thumbnail('full') ; ?>
		</a>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<div class="row">

			<div class="col-md-6">
				<?php  if ( $show_tag != 1 ) {  education_lms_posted_tag(); } ?>
			</div>

			<div class="col-md-6">
				<?php  if ( $show_sharing != 1 ) { ?>
				<ul class="list-inline list-unstyled pull-right social-share">
					<li class="heading"><?php esc_html_e('Share:', 'education-lms') ?></li>
					<li><div class="facebook-social"><a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" title="<?php esc_html_e('Facebook', 'education-lms') ?>"><i class="fa fa-facebook"></i></a></div></li>
					<li><div class="googleplus-social"><a target="_blank" class="googleplus" href="https://plus.google.com/share?url=<?php the_permalink() ?>&title=<?php the_title() ?>" title="<?php esc_html_e('Google Plus', 'education-lms') ?>" onclick="window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google"></i></a></div></li>
					<li><div class="twitter-social"><a target="_blank" class="twitter" href="https://twitter.com/home?status=<?php the_permalink() ?>&text=<?php the_title() ?>" title="<?php esc_html_e('Twitter', 'education-lms') ?>"><i class="fa fa-twitter"></i></a></div></li>
					<li><div class="pinterest-social"><a target="_blank" class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&description=<?php the_title() ?>&media=<?php echo esc_url( $featured_img_url ) ?>" onclick="window.open(this.href); return false;" title="<?php esc_html_e('Pinterest', 'education-lms') ?>"><i class="fa fa-pinterest-p"></i></a></div></li>
				</ul>
                <?php } ?>
			</div>
		</div>
	</div>


</article><!-- #post-<?php the_ID(); ?> -->