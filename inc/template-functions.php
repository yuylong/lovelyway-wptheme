<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Fashion Blogging
 */

function fashion_blogging_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'fashion_blogging_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fashion_blogging_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'fashion_blogging_pingback_header' );
if ( ! function_exists( 'fashion_blogging_comment_list' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Shape 1.0
	 */
	function fashion_blogging_comment_list( $comment, $args, $depth ) {
		extract( $args, EXTR_SKIP );
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
  <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' == $args['style'] ) : ?>
  <div id="div-comment-<?php comment_ID(); ?>" class="comment-body review-list">
	<?php endif; ?>
	<div class="single-comment">
		<div class="commenter-image">
			<?php
			if ( 0 != $args['avatar_size'] ) {
				echo get_avatar( $comment, $args['avatar_size'] );}
			?>
		</div>
		<div class="commnenter-details">
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'fashion-blogging' ); ?></em>
			<br />
		<?php endif; ?>
			<div class="comment-meta">
				<div class="comment-time">
					<p>
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
								echo esc_html( get_comment_date() . ' ' );
								echo esc_html( get_comment_time() );
							?>
						</time>
					</p>
				</div>
				<h4><?php printf( wp_kses_post( '%s', 'fashion-blogging' ), sprintf( '%s', get_comment_author_link() ) ); ?></h4>
			</div>
				<?php comment_text(); ?>
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
				?>
		</div>
	</div>
		<?php if ( 'div' == $args['style'] ) : ?>
  </div>
			<?php
  endif;
	}
endif; // ends check for fashion_blogging_comment_list();

/**
 * Author VCard
 */
function fashion_blogging_author_vcard() {
	?>
	<div class="author-vcard">
		<div class="author-vcard__image">
			<?php
			echo get_avatar( get_the_author_meta( 'ID' ), 100, '', '', null );
			?>
		</div>
		<div class="author-vcard__about">
			<h4><?php echo esc_html( get_the_author_meta( 'nickname' ) ); ?></h4>
			<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
			<p>
			<?php
			$userpost_count = count_user_posts( get_the_author_meta( 'ID' ), 'post', false );
			if ( $userpost_count > 1 ) {
				$numberingtext = 'posts';
			} else {
				$numberingtext = 'post';
			}
			$userposts = esc_html__( 'the user has only %1$s %2$s', 'fashion-blogging' );
			printf( $userposts, $userpost_count, $numberingtext );
			?>
			 </p>
		</div>
	</div>
	<?php
	return;
}

function lw_list_images_with_prefix($attrs, $content='index-topic-') {
    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'numberposts'    => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => array(
            array(
                'key'     => '_wp_attached_file',
                'value'   => $content,
                'compare' => 'LIKE',
            ),
        ),
    );

	$posts = get_posts($args);

    if (!empty($posts)) {
		for ($i = 0; $i < count($posts); $i++) {
			$image_id = $posts[$i]->ID;
			$image_url = wp_get_attachment_url($image_id);
			$image_caption = wp_get_attachment_caption($image_id);
			$image_description = $posts[$i]->post_content;
			?>
			<figure class="wp-block-image aligncenter size-full">
				<img src="<?php echo esc_url( $image_url ); ?>" alt="" class="wp-image-16" style="max-height:520px;"/>
				<figcaption class="wp-element-caption" ><?php echo esc_html( $image_caption ); ?><br>
				<?php echo esc_html( $image_description ); ?></figcaption>
			</figure>
			<?php
		}
	} else {
		echo '<p>No images found with Prefix ' . $content . '</p>';
	}
	wp_reset_postdata();
}

function fashion_blogging_before_default_page_markup() {
	if (is_home()) {
		$sidebar_layouts = get_theme_mod( 'blog_page_sidebar', 'no' );
	}elseif (is_archive()) {
		$sidebar_layouts = get_theme_mod('archive_page_sidebar', 'no');
	}elseif (is_page()) {
		$sidebar_layouts = get_theme_mod('page_sidebar', 'no');
	}elseif (is_single()) {
		$sidebar_layouts = get_theme_mod('post_sidebar', 'no');
	}
	$blogcontent    = 'col-md-12';
	if ( $sidebar_layouts === 'right' ) {
		$blogcontent = 'col-md-7 col-lg-8 order-0';
	} elseif ( $sidebar_layouts === 'left' ) {
		$blogcontent = 'col-md-7 col-lg-8 order-1';
	} elseif ( $sidebar_layouts === 'no' ) {
		$blogcontent = 'col-md-12';
	} else {
		$blogcontent = 'col-md-12';
	}
	?>
		<div class="blog-post-section">
			<div class="container">
				<div class="row">
					<div class="<?php echo esc_attr( $blogcontent ); ?>">
	<?php

	add_shortcode('list_topicimg', 'lw_list_images_with_prefix');
}
add_action( 'fashion_blogging_before_default_page', 'fashion_blogging_before_default_page_markup' );

function fashion_blogging_after_default_page_markup() {

	if (is_home()) {
		$sidebar_layouts = get_theme_mod( 'blog_page_sidebar', 'no' );
	}elseif (is_archive()) {
		$sidebar_layouts = get_theme_mod('archive_page_sidebar', 'no');
	}elseif (is_page()) {
		$sidebar_layouts = get_theme_mod('page_sidebar', 'no');
	}elseif (is_single()) {
		$sidebar_layouts = get_theme_mod('post_sidebar', 'no');
	}

	$blogsidebar    = 'col-md-5 col-lg-4 order-1 pl-xl-5';
	$sidebarshow    = true;
	if ( $sidebar_layouts === 'right' ) {
		$blogsidebar = 'col-md-5 col-lg-4 order-1 pl-xl-5';
		$sidebarshow = true;
	} elseif ( $sidebar_layouts === 'left' ) {
		$blogsidebar = 'col-md-5 col-lg-4 order-0 pl-xl-5';
		$sidebarshow = true;
	} elseif ( $sidebar_layouts === 'no' ) {
		$blogsidebar = 'sidebar-hide';
		$sidebarshow = false;
	} else {
		$blogsidebar = 'col-md-5 col-lg-4 order-1 pl-xl-5';
	}

	?>
					 </div>
					<?php if ( $sidebarshow === true ) : ?>
						<div class="<?php echo esc_attr( $blogsidebar ); ?>">
							<?php get_sidebar(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
}
add_action( 'fashion_blogging_after_default_page', 'fashion_blogging_after_default_page_markup' );

/**
 * Get Current Year
 */

 function fashion_blogging_currentYear(){
    return date('Y');
}

/**
 * Get theme Data
 */
function fashion_blogging_author(){
	$themeData = wp_get_theme();
	return $authorURI = $themeData->get( 'Author' );
}

function fashion_blogging_author_uri(){
	$themeData = wp_get_theme();
	return $authorURI = $themeData->get( 'AuthorURI' );
}

/**
 * WordPress Default Lazy Load Control From Customizer
 */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

function lwmain_get_image_url_by_filename($filename) {
    $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => 1,
        'post_status'    => 'inherit',
        'meta_query'     => array(
            array(
                'key'     => '_wp_attached_file',
                'value'   => $filename,
                'compare' => 'LIKE',
            ),
        ),
    );

    $attachments = get_posts($args);

    if ($attachments) {
        return wp_get_attachment_url($attachments[0]->ID);
    } else {
        return 'No attachment found with that filename.';
    }
}

function lw_get_latest_image_with_prefix($prefix) {
    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'numberposts'    => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => array(
            array(
                'key'     => '_wp_attached_file',
                'value'   => $prefix,
                'compare' => 'LIKE',
            ),
        ),
    );

    $posts = get_posts($args);

    if (!empty($posts)) {
        $image_id = $posts[0]->ID;

        $image_url = wp_get_attachment_url($image_id);
        $image_title = get_the_title($image_id);
        $image_caption = wp_get_attachment_caption($image_id);
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        $image_description = $posts[0]->post_content;

        $image_info = array(
            'url'         => $image_url,
            'title'       => $image_title,
            'caption'     => $image_caption,
            'alt'         => $image_alt,
            'description' => $image_description,
        );

        return $image_info;
    }

    return false;
}