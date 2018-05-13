<?php
/* Template Name: Address*/
?>
<?php get_header(); ?>
    <div id="main-page">
        <div class="container">
            <div class="main-page container-inner">
                <div class="row">
                    <div class="col-main col-xs-12 col-sm-9">
                        <?php dimox_breadcrumbs() ?>
                        <?php  while(have_posts()): the_post();?>
                            <div class="content-address">
                                <?php $list = get_field("list"); ?>
                                <?php if($list){
                                    foreach ($list as $item) { ?>
                                        <div class="wapper-item-address">
                                            <?php if ($item["title"]){ ?>
                                                <div class="parent-li">
                                                    <?php echo $item["title"] ?>
                                                </div>
                                            <?php } ?>
                                            <div class="main-item-address">
                                                <div class="title-address">
                                                    <?php echo $item["address"] ?>
                                                </div>
                                                <?php
                                                $listinfo = $item["info"];
                                                if ($listinfo){
                                                    ?>
                                                    <table class="listinfo">
                                                        <?php foreach ($listinfo as $info){ ?>
                                                            <tr>
                                                                <td class="td-title"><?php echo $info["title"] ?></td>
                                                                <td><?php echo $info["content"] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                <?php } ?>
                                                <?php if($item["content"]){ ?>
                                                    <div class="wapper-action-content-item-info">
                                                        <div class="action-address">
                                                            <a data-click="0" class="a-action-address" href="javascript:void(0)">» Xem chi tiết</a>
                                                        </div>
                                                        <div style="display: none" class="content-item-address">
                                                            <?php echo $item["content"]; ?>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                } ?>

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