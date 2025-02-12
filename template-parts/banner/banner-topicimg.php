<?php
    global $product;
    
    //get products on sale using wp_query class
    $topic_image = lw_get_latest_image_with_prefix('index-topic-');
    if ( $topic_image ) :
?>
<div class="post-container">
    <figure class="wp-block-image aligncenter size-full" style="margin-top: 0; margin-bottom: 0;">
        <img src="<?php echo esc_url( $topic_image['url'] ); ?>" alt="" class="wp-image-16" style="max-height:520px; margin-top: 20px; margin-bottom: 0;"/>
        <figcaption class="wp-element-caption" style="margin-top: 0; margin-bottom: 0;"><?php echo esc_html( $topic_image['caption'] ); ?><br>
        <?php echo esc_html( $topic_image['description'] ); ?></figcaption>
    </figure>
</div>
<?php
    else:
        echo '<p>No topic image found.</p>';
    endif;
?>