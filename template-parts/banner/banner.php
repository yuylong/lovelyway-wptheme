<?php
/**
 * Fashion Blogging Hero Home two
 */

$banner_post_type = get_theme_mod('select_post_types');
?>
<section id="hero-section" class="<?php ($banner_post_type == "post" || $banner_post_type == "topicimg") ? "banner-section":"";?>">
<?php
    if($banner_post_type == "topicimg"){
        get_template_part( 'template-parts/banner/banner', 'topicimg');
    }
?>
<?php
    if($banner_post_type == "post"){
        get_template_part( 'template-parts/banner/banner', 'post');
    }
?>
<?php
    if($banner_post_type == "products"){
    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        get_template_part( 'template-parts/banner/banner', 'products');
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
?>
</section>
