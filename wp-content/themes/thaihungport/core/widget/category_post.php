<?php

class CategoryPosts extends WP_Widget {

    function CategoryPosts() {
        parent::__construct(
            'category_post',
            'category post',
            array( 'description'  =>  'Widget hiển thị bài viết theo category' )
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
        _e( 'Category' );
        wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"],'value' => $cat ) );
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
        echo "<div class='category-widget'>";
        if($title){
            echo $before_title.$title.$after_title;
        }
        wp_reset_query();
        $args   =   array(
            'post_type'         =>  'post',
            'showposts'         => $post_number,
            'tax_query'         =>   array(
                array(
                    'taxonomy'  =>  'category',
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
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo aq_resize(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) , 81, 81, true );?>"></a>
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
add_action( 'widgets_init', create_function('', 'return register_widget("CategoryPosts");') );
?>