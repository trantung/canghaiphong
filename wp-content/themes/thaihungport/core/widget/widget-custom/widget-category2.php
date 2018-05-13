<?php

class widgtCategory2Custom extends WP_Widget {

    function widgtCategory2Custom() {
        parent::__construct(
            'category_post 2',
            'category post 2',
            array( 'description'  =>  'Widget category' )
        );
    }

    function form( $instance ) {


    }

    function update($new_instance, $old_instance) {

    }

    function widget( $args, $instance ) {
        $categoryID = get_field('category', 'widget_'.$args["widget_id"]);

        $args['before_widget'] = preg_replace( '/(?<=\sclass=["\'])/', 'category_post_custom ', $args['before_widget'] );
        echo $args['before_widget'];
        ?>
        <div class="widget-category">
            <div class="wapper-header-row-block-1">
                <a href="<?php echo get_category_link($categoryID)?>"><h2><?php echo get_cat_name($categoryID) ?></h2></a>
                <div class="list-title-block-1 text-right">
                </div>
            </div>
            <?php
            wp_reset_query();
            $args   =   array(
                'post_type'         =>  'post',
                'showposts'         =>  4,
                'tax_query'         =>   array(
                    array(
                        'taxonomy'  =>  'category',
                        'field'     =>  'id',
                        'terms'     =>  $categoryID,
                    ),
                ),
            );
            $query  = new WP_Query($args);
            $count = 0;
            ?>
            <div class="list-widget-category">
                <ul>
                    <?php while($query->have_posts()): $query->the_post();$count++;
                        if($count==1){
                            ?>
                            <li>
                                <div class="thum-first-item-widget-category-2">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo aq_resize(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) , 220, true ); ?>">
                                    </a>
                                </div>
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            </li>
                        <?php }else{ ?>
                            <li>
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            </li>
                        <?php } ?>
                    <?php endwhile;wp_reset_query(); ?>
                </ul>
            </div>
        </div>
        <?php
        echo "</aside>";
    }



}
add_action( 'widgets_init', create_function('', 'return register_widget("widgtCategory2Custom");') );
?>