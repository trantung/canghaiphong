<?php

class VanbanPosts extends WP_Widget {

    function VanbanPosts() {
        parent::__construct(
            'vanban_post',
            'danh mục văn bản',
            array( 'description'  =>  'Widget hiển thị bài viết theo Danh mục văn bản' )
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
            'taxonomy'           => 'danhmucvanban',
            'hide_if_empty'      => false,
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
        echo "<div class='vanban-widget'>";
        if($title){
            ?>
            <h3 class="s-title-box1">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                <?php echo $title?>
            </h3>
            <?php
        }
        wp_reset_query();
        $args   =   array(
            'post_type'         =>  'vanban',
            'showposts'         => $post_number,
            'tax_query'         =>   array(
                array(
                    'taxonomy'  =>  'danhmucvanban',
                    'field'     =>  'id',
                    'terms'     =>  $cat,
                ),
            ),
        );
        $query  = new WP_Query($args);
        echo "<ul class='category-list'>";
        while($query->have_posts()): $query->the_post(); ?>
            <li class="item-list-box item-widget-vanban">
                <div class="grid">
                    <div class="thumb-box1">
                        <?php if(has_post_thumbnail()){ ?>
                            <img alt="<?php the_title() ?>" src="<?php echo aq_resize(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) , 40, 40, true ); ?>"/>
                        <?php }else{ ?>
                            <img alt="<?php the_title() ?>" src="<?php echo get_template_directory_uri()?>/images/th.jpg"/>
                            <?php
                        } ?>
                    </div>
                    <div class="title-item-idget-vanban">
                        <a href="<?php the_permalink() ?>">
                            <h4><?php the_title() ?></h4>
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <?php
        endwhile;wp_reset_query();
        echo "</ul>";
        echo '</div>';
        echo $after_widget;

    }



}
add_action( 'widgets_init', create_function('', 'return register_widget("VanbanPosts");') );
?>