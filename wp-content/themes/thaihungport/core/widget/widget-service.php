<?php

class ServicePosts extends WP_Widget {

    function ServicePosts() {
        parent::__construct(
            'service_post',
            'service post',
            array( 'description'  =>  'Widget hiển thị bài viết theo service' )
        );
    }

    function form( $instance ) {

        $default = array(

        );
        $instance = wp_parse_args( (array) $instance, $default );
        $title = esc_attr($instance['title']);
        $cat = esc_attr($instance['cat']);
        $post_number = esc_attr($instance['post_number']);

        echo '<p>Nhập tiêu đề <input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'"/></p>';
        $args = array(
            'show_option_all'   => 'All Service',
            'show_option_none'  => '',
            'orderby'           => 'id',
            'order'             => 'ASC',
            'show_count'        => 0,
            'hide_empty'        => 1,
            'child_of'          => 0,
            'exclude'           => '',
            'echo'              => 1,
            'selected'           => $instance["cat"],
            'hierarchical'      => 0,
            'name'              => $this->get_field_name("cat"),
            'id'                => '',
            'class'             => 'service',
            'depth'             => 0,
            'tab_index'         => 0,
            'taxonomy'          => 'services-category',
            'hide_if_empty'     => false,
            'option_none_value' => -1,
            'value_field'       => 'term_id',
            'required'          => false,
        );
        wp_dropdown_categories( $args );
        echo '<p>Số lượng bài viết hiển thị <input type="number" class="widefat" name="'.$this->get_field_name('post_number').'" value="'.$post_number.'" placeholder="'.$post_number.'" max="30" /></p>';

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
        return $new_instance;
    }

    function widget( $args, $instance ) {

        extract($args);
        $title = apply_filters( 'widget_title', $instance['title'] );
        $cat = $instance['cat'];
        $post_number = $instance['post_number'];

        echo $before_widget;
        echo "<div class='service-widget'>";
        if($title){
            echo $before_title.$title.$after_title;
        }

        wp_reset_query();
        $args   =   array(
            'post_type'         =>  'services',
            'showposts'         => $post_number,
            'tax_query'         =>   array(
                array(
                    'taxonomy'  =>  'services-category',
                    'field'     =>  'id',
                    'terms'     =>  $cat,
                ),
            ),
        );
        $query  = new WP_Query($args);
        echo "<ul class='category-list'>";
        while($query->have_posts()): $query->the_post(); ?>
            <li>
                <div class="wapper-thumbnail-category">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo aq_resize(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) , 88, 88, true );?>"></a>
                </div>
                <h4 class="title-category">
                    <a class="link-category" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </h4>
                <div class="clear"></div>
            </li>
            <?php
        endwhile;wp_reset_query();
        echo "</ul>";
        echo '</div>';
        echo $after_widget;

    }



}
add_action( 'widgets_init', create_function('', 'return register_widget("ServicePosts");') );
?>