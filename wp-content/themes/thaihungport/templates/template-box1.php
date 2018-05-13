<?php
$list = get_sub_field('list');
?>
<div class="box1">
    <div class="container">
        <div class="content-box1 container-inner">
            <?php if($list){ ?>
                <div class="row">
                    <?php foreach ($list as $item){?>
                        <div class="banner-box banner-box1 col-sm-4 col-md-4 col-sms-12">
                            <div class="banner-col" style="background-image: url('<?php echo $item["image"]?>') ">
                                <h2><a href="<?php echo $item["link"]; ?>"><?php echo $item["title"]; ?></a></h2>
                                <div class="content-item-box1">
                                    <?php echo $item["content"]; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>