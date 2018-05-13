<?php
/* Template Name: Project*/
?>
<?php get_header(); ?>
<div id="main-page">
    <div class="container">
        <div class="main-page container-inner">
            <div class="row">
                <div class="col-main col-xs-12 col-sm-9">
                    <?php dimox_breadcrumbs() ?>
                    <?php  while(have_posts()): the_post();
                        $list = get_field("list");
                    ?>
                        <div class="content-project">
                            <?php foreach ($list as $item){ ?>
                                <div class="item-project">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-5">
                                            <div class="image-item-project">
                                                <img src="<?php echo aq_resize($item["image"], 314, true ); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-7">
                                            <div class="main-item-project">
                                                <h4 class="title-item-project"><?php echo $item["title"] ?></h4>
                                                <div class="content-item-project">
                                                    <?php echo $item["content"] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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
