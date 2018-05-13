<?php
/* Template Name: Home*/
?>
<?php get_header(); ?>
    <?php
    get_template_part( 'templates/template', 'slider' );
    ?>
<div id="main-page">
    <div class="container">
        <div class="main-page container-inner" style="padding-left: 0;padding-right: 0">
            <div class="row grid">
                <div class="col-main col-xs-12 col-sm-9">
                    <?php
                    if( have_rows('template') ):
                        while ( have_rows('template') ) : the_row();
                            if( get_row_layout() == 'box1' ) {
                                get_template_part( 'templates/template', 'box1' );
                            }
                            if( get_row_layout() == 'box2' ) {
                                get_template_part( 'templates/template', 'box2' );
                            }
                            if( get_row_layout() == 'box3' ) {
                                get_template_part( 'templates/template', 'box3' );
                            }
                            if( get_row_layout() == 'box4' ) {
                                get_template_part( 'templates/template', 'box4' );
                            }
                        endwhile;endif; ?>
                </div>
                <div class="col-right col-xs-12 col-sm-3">
                    <div class="sidebar">
                        <?php if ( is_active_sidebar( 'sidebar-home' ) ) : ?>
                            <?php dynamic_sidebar( 'sidebar-home' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

