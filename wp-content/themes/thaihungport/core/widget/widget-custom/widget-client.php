<?php

class widgtClientCustom extends WP_Widget {

    function widgtClientCustom() {
        parent::__construct(
            'client',
            'client',
            array( 'description'  =>  'Widget category' )
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
        <div class="template-box7">
            <div class="header-template-box7">
                LIÊN KẾT
            </div>
            <div class="row list-template-box7">
                <?php foreach ($list as $item){
                    $image = $item['logo'];
                    ?>
                    <div class="col-md-6 col-xs-4 item-list-template-box7">
                        <a href="<?php echo $item['link'] ?>">
                            <img src="<?php echo $image ?>" alt="<?php echo $item['title'] ?>" title="<?php echo $item['title'] ?>"/>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        echo "</aside>";
    }



}
add_action( 'widgets_init', create_function('', 'return register_widget("widgtClientCustom");') );
?>