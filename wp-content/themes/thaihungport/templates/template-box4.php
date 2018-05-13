<?php
$title = get_sub_field('title');
$list = get_sub_field('list');
?>

<div class="box4">
    <div class="container">
        <div class="content-box4 container-inner">
            <?php if($title){ ?>
                <div class="title-box4">
                    <h3 class="title-s1"><?php echo $title;?></h3>
                </div>
            <?php } ?>
            <div class="main-box4">
                <?php if($list){ ?>
                    <div class="slider-style slider-box4 owl-carousel owl-theme">
                        <?php foreach ($list as $item){ ?>
                            <div class="item">
                                <a href="<?php echo $item["link"] ?>">
                                    <div class="item-box4">
                                        <img src="<?php echo aq_resize($item["image"], 159, 61, true ); ?>">
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>