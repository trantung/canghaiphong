<?php
$title = get_sub_field('title');
$list = get_sub_field('list');
?>

<div class="box2">
    <div class="container">
        <div class="content-box2 container-inner">
            <?php if($title){ ?>
            <div class="title-box2">
                <h3 class="title-s1"><?php echo $title;?></h3>
            </div>
            <?php } ?>
            <div class="main-box2">
                <?php if($list){ ?>
                    <div class="slider-style slider-box2 owl-carousel owl-theme">
                        <?php foreach ($list as $item){ ?>
                            <div class="item">
                                <a href="<?php echo $item["link"] ?>">
                                    <div class="ava-item-box2">
                                        <img src="<?php echo aq_resize($item["image"], 179, 238, true ); ?>">
                                    </div>
                                </a>
                                <div class="info-item-box2 text-center">
                                    <h4 class="name-item-box2"><?php echo $item["name"]; ?></h4>
                                    <div class="position-item-box2"><?php echo $item["position"]; ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>