<?php get_header(); ?>
    <div id="main-page">
        <div class="container">
            <div class="main-page container-inner">
                <div class="row">
                    <div class="col-main col-xs-12 col-sm-9">
                        <?php dimox_breadcrumbs() ?>
                        <div class="content-archive">
                            <?php  while(have_posts()): the_post();?>
                                <div class="item-archive">
                                    <div class="wapper-archive">
                                        <a href="<?php the_permalink() ?>">
                                            <h2 class="title-item-archive"><?php the_title(); ?></h2>
                                        </a>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-3">
                                                <a href="<?php the_permalink() ?>">
                                                    <div class="thumb-item-archive">
                                                        <img src="<?php echo aq_resize( wp_get_attachment_url(get_post_thumbnail_id($post->ID)), 176, 101, true ); ?>">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="excerpt-item-archive">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;wp_reset_query();?>
                        </div>
                        <?php wp_pagenavi(); ?>
                    </div>
                    <div class="col-right col-xs-12 col-sm-3">
                        <div class="sidebar">
                            <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                                <?php dynamic_sidebar( 'sidebar' ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>