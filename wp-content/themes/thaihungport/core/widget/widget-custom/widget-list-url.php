<?php

class widgtListUrlCustom extends WP_Widget {

    function widgtListUrlCustom() {
        parent::__construct(
            'list_url',
            'list url',
            array( 'description'  =>  'list url' )
        );
    }

    function form( $instance ) {


    }

    function update($new_instance, $old_instance) {

    }

    function widget( $args, $instance ) {
        $args['before_widget'] = preg_replace( '/(?<=\sclass=["\'])/', 'category_post_custom ', $args['before_widget'] );
        echo $args['before_widget'];
        $list = get_field('list', 'widget_'.$args["widget_id"]);
        ?>
        <div class="advert">
            <div class="mncap">
                Website liên kết
            </div>
            <select class="sidebar-url-list" name="state">
                <option value="default" selected>Chọn Website liên kết</option>
                <?php foreach ($list as $item){ ?>
                    <option value="<?php echo $item['link']?>"><?php echo $item['title']?></option>
                <?php } ?>
            </select>
        </div>
        <?php
        echo "</aside>";
    }



}
add_action( 'widgets_init', create_function('', 'return register_widget("widgtListUrlCustom");') );
?>