<?php

class social extends WP_Widget {

    function social() {
        parent::__construct(
            'social',
            'social',
            array( 'description'  =>  'Widget hiển thị liên kết đến mạng xã hội' )
        );
    }

    function form( $instance ) {

        $default = array(
            'title' => '',
            'post_number' => ''
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $youtube = esc_attr($instance['youtube']);
        $instagram = esc_attr($instance['instagram']);
        $witter = esc_attr($instance['witter']);
        $facebook = esc_attr($instance['facebook']);
        $github = esc_attr($instance['github']);

        echo '<p>Facebook <input type="text" class="widefat" name="'.$this->get_field_name('facebook').'" value="'.$facebook.'"/></p>';
        echo '<p>Witter <input type="text" class="widefat" name="'.$this->get_field_name('witter').'" value="'.$witter.'"/></p>';
        echo '<p>Youtube <input type="text" class="widefat" name="'.$this->get_field_name('youtube').'" value="'.$youtube.'"/></p>';
        echo '<p>github <input type="text" class="widefat" name="'.$this->get_field_name('github').'" value="'.$github.'"/></p>';
        echo '<p>instagram <input type="text" class="widefat" name="'.$this->get_field_name('instagram').'" value="'.$instagram.'"/></p>';

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
        $instance['youtube'] = strip_tags($new_instance['youtube']);
        $instance['instagram'] = strip_tags($new_instance['instagram']);
        $instance['witter'] = strip_tags($new_instance['witter']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['github'] = strip_tags($new_instance['github']);
        return $new_instance;
    }

    function widget( $args, $instance ) {
        $youtube = $instance['youtube'];
        $instagram = $instance['instagram'];
        $witter = $instance['witter'];
        $facebook = $instance['facebook'];
        $github = $instance['github'];
        echo $before_widget;
        ?>
        <div class="widget-ketnoi">
            <ul class="social-footer">
                <?php if($facebook){ ?>
                    <li><a href="<?php echo $facebook ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <?php   } ?>
                <?php if($witter){ ?>
                    <li><a href="<?php echo $witter ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <?php   } ?>
                <?php if($youtube){ ?>
                    <li><a href="<?php echo $youtube ?>" target="_blank"><i class="fa fa-youtube-play "></i></a></li>
                <?php   } ?>
                <?php if($github){ ?>
                    <li><a href="<?php echo $github ?>" target="_blank"><i class="fa fa-github-alt "></i></a></li>
                <?php   } ?>
                <?php if($instagram){ ?>
                    <li><a href="<?php echo $instagram ?>" target="_blank"><i class="fa fa-instagram "></i></a></li>
                <?php   } ?>
            </ul>
        </div>
    <?php
        echo $after_widget;
    }
}
add_action( 'widgets_init', create_function('', 'return register_widget("social");') );
?>