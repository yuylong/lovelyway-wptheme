<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fashion Blogging
 */
if ( ! function_exists( 'fashion_blogging_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function fashion_blogging_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		$timeIcon = '%1$s';
		$posted_on = sprintf(
			$timeIcon,
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$line = '<i class="line"></i>&nbsp;';

		echo '<span class="posted-on">'.$line.'' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;
if ( ! function_exists( 'fashion_blogging_time' ) ) {
	function fashion_blogging_time() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		echo '<i class="blog-time">' . wp_kses_post( $time_string ) . '</i>';
	}
}
if ( ! function_exists( 'fashion_blogging_posted_by' ) ) :
	function fashion_blogging_posted_by( $has_author_lead = true ) {
		$posted_by_format = '<i>%1$s</i>';
		$author_lead = esc_html ('文 / ');
		if ( false === $has_author_lead ) {
			$author_lead = '';
		}
		$postedBy = sprintf(
			$posted_by_format,
			$author_lead . get_post_meta( get_the_ID(), 'lw_author', true )
		);
		echo '<span class="posted_by">' . wp_kses_post( $postedBy ) . '</span>';
	}
endif;
if ( ! function_exists( 'fashion_blogging_comment_popuplink' ) ) {
	function fashion_blogging_comment_popuplink() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			// $commentIcon = ;
			echo '<span class="comments-link"><i class="fa fa-comments-o" aria-hidden="true"></i>';
			$css_class = 'zero-comments';
			$number    = (int) get_comments_number( get_the_ID() );
			if ( 1 === $number ) {
				$css_class = 'one-comment';
			} elseif ( 1 < $number ) {
				$css_class = 'multiple-comments';
			}
			comments_popup_link(
				__( 'Post a Comment', 'fashion-blogging' ),
				__( '1 Comment', 'fashion-blogging' ),
				__( '% Comments', 'fashion-blogging' ),
				$css_class,
				__( 'Comments are Closed', 'fashion-blogging' )
			);
			echo '</span>';
		}
	}
}
function fashion_blogging_categories() {
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
			printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
	return;
}
if ( ! function_exists( 'fashion_blogging_post_tag' ) ) {
	function fashion_blogging_post_tag() {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . wp_kses_post($tags_list) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		return;
	}
}
if ( ! function_exists( 'fashion_blogging_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function fashion_blogging_post_thumbnail() {
		$get_blog_layout = get_theme_mod( 'blog_layout', 'grid' );
		$thumbnail_size  = 'fashion-blogging-grid-thumbnail';
		if ( is_single() || is_page() ) {
			$thumbnail_size = 'fashion-blogging-thumbnail-large';
		} else {
			if ( 'list' === $get_blog_layout ) {
				$thumbnail_size = 'fashion-blogging-thumbnail-large';
			} elseif ( 'grid' === $get_blog_layout ) {
				$thumbnail_size = 'fashion-blogging-grid-thumbnail';
			}
		}
		$post_thumnail = wp_get_attachment_image_url( get_post_thumbnail_id( get_the_ID() ), $thumbnail_size );
		if ( is_single() || is_page() ) {
			 the_post_thumbnail( $thumbnail_size );
		} else {
			if ( has_post_thumbnail() ) :
				?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $thumbnail_size ); ?>
				</a>
				<?php
			elseif ( $post_thumnail ) :
				echo '<a href="' . esc_url( get_the_permalink() ) . '"><img src="' . esc_url( $post_thumnail ) . '" alt=""></a>';
			endif;
		}
	}
endif;

function fashion_blogging_navigation() {
	$next_icon            = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
	$prev_icon            = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
	$pagination_alignment = get_theme_mod( 'blog_page_pagination', 'center' );
	echo '<div class="pagination-' . esc_attr( $pagination_alignment ) . '">';
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => $prev_icon,
				'next_text' => $next_icon,
			)
		);
	echo '</div>';
}
