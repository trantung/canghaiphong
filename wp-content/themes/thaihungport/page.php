<?php get_header(); ?>
<div id="main-page">
    <div class="container">
        <div class="main-page container-inner">
            <div class="row">
                <div class="col-main col-xs-12 col-sm-9">
                    <?php dimox_breadcrumbs() ?>
                    <?php  while(have_posts()): the_post();?>
                        <div class="edit edit-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile;wp_reset_query();?>
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