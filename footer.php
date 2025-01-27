<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fashion Blogging
 */

$show_footer_social_links = get_theme_mod('show_footer_social_links', false);
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer">
	<!-- Footer Sidebar -->
	<?php get_template_part('template-parts/footer/footer', 'sidebar'); ?>
	<!-- Footer Copyright Section -->
	<section class="site-copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<div class="site-info text-center">
						<div class="site-copyright-text" style="display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;">
							<div style="margin-right:8px;">
								<img src="<?php echo lwmain_get_image_url_by_filename('beian-icon.png') ?>" style="height:14px" />
								<a href="https://beian.mps.gov.cn/#/query/webSearch?code=21011102000357" rel="noreferrer" target="_blank">辽公网安备21011102000357号</a>
							</div>|
							<div style="margin-right:8px;margin-left:8px;">
								<a href="https://beian.miit.gov.cn" target="_blank">辽ICP备2024019965号-1</a>
							</div>|
							<div style="margin-left:8px;">Copyright © 2023-2025 Yulong Yu. All rights reserved.</div>
							</div>
						</div>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
	</section>
</footer><!-- #colophon -->
<div class="scrooltotop">
	<a href="#" class="fa fa-angle-up"></a>
</div>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
