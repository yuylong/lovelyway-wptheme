<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Fashion Blogging
 */
get_header();
$s_post_el_is_on = array(
	'show_recommend_posts' => get_theme_mod('show_recommend_posts', true),
	'show_post_navigation' => get_theme_mod('show_post_navigation', true),
	'show_post_author_box' => get_theme_mod('show_post_author_box', true),
);
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php do_action('fashion_blogging_before_default_page'); ?>
			<div class="post-details-page">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'single' );
				endwhile; // End of the loop.
				if( true == $s_post_el_is_on['show_post_author_box'] ) : ?>
					<div class="post-author">
						<div class="d-md-flex align-items-center">
							<div class="author-about">
								<?php echo get_post_meta( get_the_ID(), 'lw_copyright', true ); ?>
							</div>
						</div>
					</div>
				<?php endif;
				if(true === $s_post_el_is_on['show_post_navigation']): ?>
				<div class="d-flex single-post-navigation justify-content-between">
					<?php if (get_previous_post_link()): ?>
						<div class="previous-post">
							<?php
								$prev_post = get_adjacent_post(false, '', true);
							?>
							<div class="postarrow" style="letter-spacing: 4px;">
								<a href="<?php echo get_permalink($prev_post->ID); ?>">
									<i class="fa fa-long-arrow-left"></i>
									上一篇
								</a>
							</div>
							<?php echo get_previous_post_link('%link');?>
						</div>
					<?php endif;
					if(get_next_post_link()):
					?>
					<div class="next-post">
						<?php 
							$next_post = get_adjacent_post(false, '', false);
						?>
						<div class="postarrow" style="letter-spacing: 4px;">
							<a href="<?php echo get_permalink($next_post->ID); ?>">
								下一篇
								<i class="fa fa-long-arrow-right"></i>
							</a>
						</div>
						<?php echo get_next_post_link('%link'); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif;
				if (true === $s_post_el_is_on['show_recommend_posts']) :
					echo '<div class="related-post-wrapper">';
						fashion_blogging_cats_related_post();
					echo '</div>';
				endif;
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</div>
		<?php do_action('fashion_blogging_after_default_page'); ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
