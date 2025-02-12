<?php
    global $product;
    
    //get products on sale using wp_query class
    $topic_image = lw_get_latest_image_with_prefix('index-topic-');
    if ( $topic_image ) :
?>
<div class="post-container">
    <figure class="wp-block-image aligncenter size-full">
        <img src="<?php echo esc_url( $topic_image['url'] ); ?>" alt="" class="wp-image-16"/>
        <figcaption class="wp-element-caption"><?php echo esc_html( $topic_image['caption'] ); ?><br>
        <?php echo esc_html( $topic_image['description'] ); ?></figcaption>
    </figure>
</div>
<?php
    else:
        echo '<p>No topic image found.</p>';
    endif;
?>