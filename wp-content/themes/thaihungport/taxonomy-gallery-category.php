<?php get_header(); ?>
    <div id="main-page">
        <div class="container">
            <div class="main-page container-inner">
                <div class="row">
                    <div class="col-main col-xs-12 col-sm-9">
                        <div class="breadcrumbs">
                            <span ><a href="<?php echo get_home_url(); ?>" class="home"><span>Home</span></a></span>
                            <span class="current"><?php single_cat_title() ?></span>
                        </div>
                        <div class="content-tax-archive">
                            <?php  while(have_posts()): the_post();?>
                                <div class="item-archive">
                                    <div class="wapper-archive">
                                        <a href="<?php the_permalink() ?>">
                                            <h2 class="title-item-archive"><i class="fa fa-picture-o"></i> <?php the_title(); ?></h2>
                                        </a>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4">
                                                <a href="<?php the_permalink() ?>">
                                                    <div class="thumb-item-archive">
                                                        <img src="<?php echo aq_resize( wp_get_attachment_url(get_post_thumbnail_id($post->ID)), 222, 148, true ); ?>">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xs-12 col-sm-8">
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