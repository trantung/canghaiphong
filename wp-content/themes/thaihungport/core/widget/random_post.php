<?php
class Random_Post extends WP_Widget {

    function __construct() {
        parent::__construct(
            'random_post',
            'Bài ngẫu nhiên',
            array( 'description'  =>  'Widget hiển thị bài viết ngẫu nhiên' )
        );
    }

    function form( $instance ) {

        $default = array(
            'title' => 'Tiêu đề widget',
            'post_number' => 10
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $title = esc_attr($instance['title']);
        $post_number = esc_attr($instance['post_number']);

        echo '<p>Nhập tiêu đề <input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'"/></p>';
        echo '<p>Số lượng bài viết hiển thị <input type="number" class="widefat" name="'.$this->get_field_name('post_number').'" value="'.$post_number.'" placeholder="'.$post_number.'" max="30" /></p>';

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_number'] = strip_tags($new_instance['post_number']);
        return $instance;
    }

    function widget( $args, $instance ) {
        $no_thumbnail= cs_get_option( 'no-thumbnail' );
        extract($args);
        $title = apply_filters( 'widget_title', $instance['title'] );
        $post_number = $instance['post_number'];

        echo $before_widget;
        echo '<h2 class="random-post">'.$title.'</h2>';
        $random_query = new WP_Query('posts_per_page='.$post_number.'&orderby=rand');

        if ($random_query->have_posts()):
            echo "<ul class='random-list'>";
            while( $random_query->have_posts() ) :
                $random_query->the_post(); ?>

                <li>
                    <div class="wapper-thumbnail-randompost">
                        <a href="<?php the_permalink(); ?>"><img src="<?php
                            if(has_post_thumbnail()){
                                echo aq_resize(wp_get_attachment_url(get_post_thumbnail_id($post->ID)) , 60, 60, true );
                            }else{
                                echo aq_resize( $no_thumbnail, 60, 60, true );
                            }
                            ?>"></a>
                    </div>
                    <h4 class="title-randompost">
                        <a class="link-random" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <div class="clear"></div>
                </li>

            <?php endwhile;wp_reset_query();
            echo "</ul>";
        endif;
        echo $after_widget;

    }

}

add_action( 'widgets_init', 'create_randompost_widget' );
function create_randompost_widget() {
    register_widget('Random_Post');
}