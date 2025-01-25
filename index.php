<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fashion Blogging
 */
get_header();
$show_hide_banner_section = get_theme_mod('banner_section_on_off', false);
if (true === $show_hide_banner_section) {
	get_template_part( 'template-parts/banner/banner', 'section');
}
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
	<?php
	do_action( 'fashion_blogging_before_default_page' );
	if ( have_posts() ) :
		echo '<div class="row masonaryactive">';
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content/content', get_post_type() );
			endwhile;
		echo '</div>';
			fashion_blogging_navigation();
		else :
			get_template_part( 'template-parts/content/content', 'none' );
		endif;
		do_action( 'fashion_blogging_after_default_page' );
		?>
	</main><!-- #main -->
</div>
<?php
get_footer();
