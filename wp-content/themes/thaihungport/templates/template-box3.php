<?php
$category = get_sub_field('category');
?>
<div class="box3">
    <div class="container">
        <div class="content-box3 container-inner">
            <?php if($category){ ?>
                <div class="title-box3">
                    <h3 class="title-s1"><?php echo get_cat_name($category);?></h3>
                </div>
            <?php } ?>
            <div class="main-box3">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'showpost' => 4,
                    'posts_per_page' => 4,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $category
                        ),
                    ),
                );
                $loop = new WP_Query( $args );
                ?>
                <div class="slider-style slider-box3 owl-carousel owl-theme">

                    <?php
                    if ( $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post();
                    ?>
                        <div class="item">
                            <div class="item-box3 row">
                                <div class="col-md-4">
                                    <a href="<?php the_permalink() ?>">
                                        <div class="thumb-item-box3 box-eff-image">
                                            <img src="<?php echo aq_resize( wp_get_attachment_url(get_post_thumbnail_id($post->ID)), 314, 180, true ); ?>">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="content-item-box3">
                                        <a href="<?php the_permalink() ?>">
                                            <h4 class="title-item-box3"><?php the_title(); ?></h4>
                                        </a>
                                        <div class="excerpt-item-box3">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    }
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
