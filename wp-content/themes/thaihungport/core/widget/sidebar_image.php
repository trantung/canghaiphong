<?php

function wpc_image_widget_enqueue_admin_scripts() {
    $screen = get_current_screen();

    if ( 'widgets' == $screen->id ) {
        wp_deregister_style( 'wpc-widgets-admin-style' );


        wp_enqueue_media();
        wp_register_script( 'wpc-widgets-admin-js', get_template_directory_uri(). '/js/admin.js', array ( 'jquery' ), WPC_IMAGE_WIDGET_VERSION, true );
        wp_enqueue_script( 'wpc-widgets-admin-js' );
    }
}
add_action('admin_enqueue_scripts', 'wpc_image_widget_enqueue_admin_scripts' );

class sidebar_image extends WP_Widget {

    function __construct() {
        parent::__construct(
            'widget_image',
            'Widget image',
            array( 'description'  =>  'widget image' )
        );
    }

    function form( $instance ) {
        $default = array(

        );
        $img_url = isset( $instance['img_url'] ) ? $instance['img_url'] : '';
        $title = esc_attr($instance['title']);
        $link = esc_attr($instance['link']);

        // If no menus exists, direct the user to go and create some.
        echo '<p>Title<input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'"/></p>';
        echo '<p>Link <input type="text" class="widefat" name="'.$this->get_field_name('link').'" value="'.$link.'"/></p>';
        ?>
        <div class="wpc-widgets-image-field">
            <p>Image</p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'img_url' ); ?>" name="<?php echo $this->get_field_name( 'img_url' ); ?>" type="text" value="<?php echo $img_url; ?>" />
            <a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'img_url' ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
            <a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'img_url' ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
            <div class="wpc-widgets-preview-image"><img src="<?php echo esc_attr( $img_url ); ?>" /></div>
        </div>
    <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        if ( ! empty( $new_instance['title'] ) ) {
            $instance['title'] = sanitize_text_field($new_instance['title']);
        }
        if ( ! empty( $new_instance['link'] ) ) {
            $instance['link'] = sanitize_text_field($new_instance['link']);
        }
        if ( ! empty( $new_instance['img_url'] ) ) {
            $instance['img_url'] = sanitize_text_field($new_instance['img_url']);
        }
        return $instance;
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', $instance['title'] );
        $link = $instance['link'];
        $img_url = $instance['img_url'];

        echo $before_widget;
        echo '<a href="'.$link.'"><div class="widget-image">';
            echo '<div class="wapper-image-widget">';
                echo '<img src="'.$img_url.'" />';
            echo'</div>';
            echo '<h3 class="title-sidebar-image">';
            echo $title;
            echo '</h3>';
        echo '</div></a>';
        echo $after_widget;
    }

}

add_action( 'widgets_init', 'create_sidebar_image_widget' );
function create_sidebar_image_widget() {
    register_widget('sidebar_image');
}