<?php
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');
header("Content-type: text/css; charset: UTF-8");

$background_style = get_field('background_style', 'options');
$color_style = get_field('color_style', 'options');
$hover_color_style = get_field('hover_color_style', 'options');
$hover_color_menu_style = get_field('hover_color_menu_style', 'options');
$box=get_field('box', 'options');
$background_body_img=get_field('background_body_img', 'options');
$background_body_color=get_field('background_body_color', 'options');
$footer=get_field('footer', 'options');
$background_tab_bar	=get_field('background_tab_bar	', 'options');

if($background_style){?>
    .background-style,.wtf-menu ul,.selected{
    background: <?php echo $background_style; ?>;
    }
<?php
}

if($color_style){ ?>
    .color-style{
    color: <?php echo $color_style; ?>;
    }
<?php
}

if($hover_color_style){?>
    .hover-color-style:hover{
    color: <?php echo $hover_color_style; ?>;
    }
<?php

}

if($hover_color_menu_style){?>
    ul.wtf-menu li a:hover,.widget-edit-menu a:hover{
    color: <?php echo $hover_color_menu_style; ?>;
    }
<?php
}

if($box){?>
    .background-all{
    background: url("<?php if($background_body_img){ echo $background_body_img['url']; } ?>") <?php if($background_body_color){ echo $background_body_color; } ?> ;
    }
<?php
}

if($footer){?>
    #footer{
    background: <?php echo $footer; ?>;
    }
<?php
}

if($background_tab_bar){?>
    .wapper-item-shop-index header{
    background: url("<?php echo $background_tab_bar['url']; ?>");
    }
<?php
}