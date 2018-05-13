<?php get_header(); ?>
    <div id="main-page">
        <div class="container">
            <div class="main-page container-inner">
                <div class="row">
                    <div class="col-main col-xs-12 col-sm-9">
                        <?php $images = get_field('gallery'); ?>
                        <div class="breadcrumbs">
                            <span><a href="<?php echo get_home_url(); ?>" class="home"><span>Home</span></a></span>
                            <span><?php get_title_category_in_post(get_the_ID(),"gallery-category") ?></span>
                            <span><?php the_title();echo count($images);?></span>
                        </div>
                        <div class="content-single">
                            <?php  while(have_posts()): the_post();?>
                                <h1 class="title-single">
                                    <?php the_title() ?>
                                </h1>
                                <div class="edit edit-content">
                                    <?php the_content(); ?>
                                </div>
                            <?php endwhile;wp_reset_query();?>
                        </div>
                        <?php
                        if( $images ): ?>
                        <div class="single-gallery">
                            <div class="row">
                                <?php foreach( $images as $image ): ?>
                                    <div class="col-md-4">
                                        <div class="item-single-gallery">
                                            <a href="<?php echo $image['url']; ?>"  data-fancybox="preview">
                                                <img src="<?php echo aq_resize($image['url'], 240, 164, true ); ?>">
                                            </a>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
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