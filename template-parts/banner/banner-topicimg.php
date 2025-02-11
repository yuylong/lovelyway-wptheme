<?php
    global $product;
    
    //get products on sale using wp_query class
    $topic_image = lw_get_latest_image_with_prefix('index-topic-');
?>
<div class="post-container">
    <div class="post__wrap-post">
        <div>
            <div class="post__wrap-sale" style="background-image: url('<?php echo $topic_image->url; ?>');">
                <div class="post-content">
                    <?php
                    $content = substr(get_the_content(), 0, 250) . '...';
                    ?>
                    <div class="post-description">
                        <div class="desctiption__wrap">
                            <div class="description__wrap-title">
                                <h2><?php echo $topic_image->caption; ?></h2>
                            </div>
                        </div>
                        <p><?php echo $topic_image->description; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>