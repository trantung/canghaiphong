<?php
class lienhe extends WP_Widget {

    function __construct() {
        parent::__construct(
            'lienhe',
            'Liên hệ',
            array( 'description'  =>  'Widget hiện liên hệ và email' )
        );
    }

    function form( $instance ) {

        $default = array(
            'title' => '',
            'post_number' => ''
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $hotline = esc_attr($instance['hotline']);
        $email = esc_attr($instance['email']);

        echo '<p>Hot line <input type="text" class="widefat" name="'.$this->get_field_name('hotline').'" value="'.$hotline.'"/></p>';
        echo '<p>Email <input type="text" class="widefat" name="'.$this->get_field_name('email').'" value="'.$email.'"/></p>';


    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['hotline'] = strip_tags($new_instance['hotline']);
        $instance['email'] = strip_tags($new_instance['email']);
        return $instance;
    }

    function widget( $args, $instance ) {
        extract($args);
        $hotline = apply_filters( 'widget_title', $instance['hotline'] );
        $email = $instance['email'];

        echo $before_widget;
            ?>
            <div class="widget-lienhe">
                <?php if($hotline){ ?>
                <div class="item-widget-lienhe">
                    <div class="icon-item-widget-lienhe"><i class="fa fa-phone"></i></div>
                    <div class="main-item-widget-lienhe">
                        <h3>Hotline bán hàng</h3>
                        <div class="hotline-widget"><?php echo $hotline ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php  } ?>
                <?php if($email){ ?>
                <div class="item-widget-lienhe">
                    <div class="icon-item-widget-lienhe"><i class="fa fa-envelope"></i></div>
                    <div class="main-item-widget-lienhe">
                        <h3>Email</h3>
                        <div class="email-widget"><?php echo $email ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php  } ?>
            </div>
<?php
        echo $after_widget;

    }

}

add_action( 'widgets_init', 'create_lienhe_widget' );
function create_lienhe_widget() {
    register_widget('lienhe');
}