<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title><?php
        /*
         * Print the <title> tag based on what is being viewed.
         */
        global $page, $paged;
        wp_title( '|', true, 'right' );
        // Add the blog name.
        bloginfo( 'name' );
        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', TEXT_DOMAIN ), max( $paged, $page ) );
        ?></title>
    <?php wp_head();?>
</head>
<?php
$title_site = get_field('title_site', 'options');
$logo = get_field('logo', 'options');
$working_time = get_field('working_time', 'options');
$phone = get_field('phone', 'options');
?>
<body>
<div id="page">
    <header id="header">
        <div class="container">
            <div class="header">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <a class="logo" title="<?php
                            if($title_site){
                                echo $title_site;
                            }else{
                                echo $bloginfo = get_bloginfo( $show, $filter );
                            }
                            ?>" href="<?php echo get_home_url(); ?>">
                                <img src="<?php echo $logo['url'] ?>">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="header-box">
                            <div class="currency-language text-right">
                                <ul>
                                    <li><a href="#"><img src="<?php echo get_template_directory_uri()?>/images/vn.jpg"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-static">
                            <?php if($phone){ ?>
                            <div class="col header-call col-1-info-header">
                                <h2>Điện thoại</h2>
                                <p><?php echo $phone;?></p>
                            </div>
                            <?php } ?>
                            <?php if($working_time){ ?>
                            <div class="col header-call">
                                <h2>Thời gian làm việc</h2>
                                <p><?php echo $working_time ?></p>
                            </div>
                            <?php } ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="menu-mobile">DANH MỤC</div>
    <nav class="nav">
        <?php wp_nav_menu(array( // Hiển thị menu Desktop
            'theme_location' => 'main-menu',
            'menu_class' => 'nav-list',
        )); ?>
    </nav>
    <div id="main-menu">
        <div class="container">
            <div class="main-menu">
                <?php wp_nav_menu(array( // Hiển thị menu Desktop
                    'theme_location' => 'main-menu',
                    'menu_class' => 'wtf-menu',
                )); ?>
            </div>
        </div>
    </div>