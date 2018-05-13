<?php

class tourPosts extends WP_Widget {

    function tourPosts() {
        parent::__construct(
            'product_post',
            'product post',
            array( 'description'  =>  'Widget hiển thị bài viết theo product' )
        );
    }

    function form( $instance ) {

        $default = array(

        );
        $instance = wp_parse_args( (array) $instance, $default );
        $title = esc_attr($instance['title']);
        $cat = esc_attr($instance['cat']);
        $post_number = esc_attr($instance['post_number']);
        $sale_price = esc_attr($instance['sale_price']);

        echo '<p>Nhập tiêu đề <input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'"/></p>';
        $args = array(
            'show_option_all'    => 'All Catagories',
            'show_option_none'   => '',
            'orderby'            => 'ID',
            'order'              => 'ASC',
            'show_count'         => 1,
            'hide_empty'         => 0,
            'child_of'           => 0,
            'exclude'            => '1,5',
            'echo'               => 1,
            'selected'           => $instance["cat"],
            'hierarchical'       => 0,
            'name'               => $this->get_field_name("cat"),
            'id'                 => '',
            'class'              => 'postform',
            'depth'              => 1,
            'tab_index'          => 0,
            'value' => $cat,
            'taxonomy'           => 'product_cat',
            'hide_if_empty'      => false,
        );
        wp_dropdown_categories( $args );
        echo '<p>Số lượng bài viết hiển thị <input type="number" class="widefat" name="'.$this->get_field_name('post_number').'" value="'.$post_number.'" placeholder="'.$post_number.'" max="30" /></p>';
        ?>
        <p>Hiển thị sản phẩm giảm giá
        <input class="checkbox" type="checkbox" <?php checked( $sale_price, 'on' ); ?> id="<?php echo $this->get_field_id( 'sale_price' ); ?>" name="<?php echo $this->get_field_name( 'sale_price' ); ?>" />
        </p>
    <?php

    }

    function update($new_instance, $old_instance) {
        /**
         * Save the thumbnail dimensions outside so we can
         * register the sizes easily. We have to do this
         * because the sizes must registered beforehand
         * in order for WP to hard crop images (this in
         * turn is because WP only hard crops on upload).
         * The code inside the widget is executed only when
         * the widget is shown so we register the sizes
         * outside of the widget class.
         */
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['cat'] = strip_tags($new_instance['cat']);
        $instance['post_number'] = strip_tags($new_instance['post_number']);
        $instance['sale_price'] = strip_tags($new_instance['sale_price']);
        return $new_instance;
    }

    function widget( $args, $instance ) {

        extract($args);
        $title = apply_filters( 'widget_title', $instance['title'] );
        $cat = $instance['cat'];
        $post_number = $instance['post_number'];
        $sale_price = $instance['sale_price'];

        echo $before_widget;
            ?>
            <div class="wapper-widget-product">
                <?php
                echo $before_title.$title.$after_title;

                wp_reset_query();
                if($sale_price){
                    $args   =   array(
                        'post_type'         =>  'product',
                        'showposts'         => $post_number,
                        'tax_query'         =>   array(
                            array(
                                'taxonomy'  =>  'product_cat',
                                'field'     =>  'id',
                                'terms'     =>  $cat,
                            ),
                        ),
                        'meta_query' => array(
                            array(
                                'key' => '_visibility',
                                'value' => array('catalog', 'visible'),
                                'compare' => 'IN'
                            ),
                            array(
                                'key' => '_sale_price',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'NUMERIC'
                            )
                        )
                    );
                }else{
                    $args   =   array(
                        'post_type'         =>  'product',
                        'showposts'         => $post_number,
                        'tax_query'         =>   array(
                            array(
                                'taxonomy'  =>  'product_cat',
                                'field'     =>  'id',
                                'terms'     =>  $cat,
                            ),
                        ),
                    );
                }

                $query  = new WP_Query($args);


                ?>
                <ul>
                    <?php while($query->have_posts()): $query->the_post(); ?>
                    <li>
                        <div class="wapper-thumbnail-product">
                            <a href="<?php the_permalink(); ?>"><img src="<?php
                                if(has_post_thumbnail()){
                                    echo aq_resize(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) , 80, 80, true );
                                }
                                ?>"></a>
                        </div>
                        <div class="content-widget-product">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="pricewidget">
                                <?php
                                /**
                                 * woocommerce_after_shop_loop_item_title hook
                                 *
                                 * @hooked woocommerce_template_loop_rating - 5
                                 * @hooked woocommerce_template_loop_price - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop_item_title' );
                                ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <?php endwhile;wp_reset_query(); ?>
                </ul>
            </div>
            <?php
        echo $after_widget;

    }



}
add_action( 'widgets_init', create_function('', 'return register_widget("tourPosts");') );
?>