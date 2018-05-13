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

class menu_bg extends WP_Widget {

    function __construct() {
        parent::__construct(
            'menubg',
            'menu(Background style)',
            array( 'description'  =>  'Widget hiển thị menu có background style' )
        );
    }

    function form( $instance ) {

        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        $img_url = isset( $instance['img_url'] ) ? $instance['img_url'] : '';

        // Get menus
        $menus = wp_get_nav_menus();

        // If no menus exists, direct the user to go and create some.
        ?>
        <p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <?php
            if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
                $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
            } else {
                $url = admin_url( 'nav-menus.php' );
            }
            ?>
            <?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
        </p>
        <div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ) ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ( $menus as $menu ) : ?>
                        <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
                            <?php echo esc_html( $menu->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div>
        <div class="wpc-widgets-image-field">
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
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
        }
        if ( ! empty( $new_instance['nav_menu'] ) ) {
            $instance['nav_menu'] = (int) $new_instance['nav_menu'];
        }
        if ( ! empty( $new_instance['img_url'] ) ) {
            $instance['img_url'] = sanitize_text_field($new_instance['img_url']);
        }
        return $instance;
    }

    function widget( $args, $instance ) {
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
        $img_url = isset( $instance['img_url'] ) ? $instance['img_url'] : '';

        if ( !$nav_menu )
            return;

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];
        ?>
        <div class="background-style widget-edit-menu" <?php if($img_url){?> style="background: url('<?php echo $img_url; ?>')" <?php } ?>>
<?php

        if ( !empty($instance['title']) )
            echo $args['before_title'] . $instance['title'] . $args['after_title'];

        $nav_menu_args = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu
        );

        /**
         * Filter the arguments for the Custom Menu widget.
         *
         * @since 4.2.0
         * @since 4.4.0 Added the `$instance` parameter.
         *
         * @param array    $nav_menu_args {
         *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
         *
         *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
         *     @type mixed         $menu        Menu ID, slug, or name.
         * }
         * @param stdClass $nav_menu      Nav menu object for the current menu.
         * @param array    $args          Display arguments for the current widget.
         * @param array    $instance      Array of settings for the current widget.
         */
        wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );
        echo '</div>';
        echo $args['after_widget'];

    }

}

add_action( 'widgets_init', 'create_menu_bg_widget' );
function create_menu_bg_widget() {
    register_widget('menu_bg');
}