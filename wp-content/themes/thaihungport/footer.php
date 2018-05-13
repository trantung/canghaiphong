<?php
$title_footer = get_field('title_footer', 'options');
$content_footer = get_field('content_footer', 'options');
$logo_footer = get_field('logo_footer', 'options');
$link = get_field('link_logo_footer', 'options');

?>
<footer id="footer">
    <div class="container">
        <div class="footer">
            <div class="row">
                <div class="col-xs-12 col-sm-10">
                    <div class="left-footer">
                        <?php if ($title_footer){ ?>
                            <h3 class="title-footer"><?php echo $title_footer;?></h3>
                        <?php } ?>
                        <div class="content-footer">
                            <?php echo $content_footer ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <a class="logo-footer" href="<?php echo $link; ?>">
                        <img src="<?php echo $logo_footer ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="ma-footer-container">
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="address-copyright">
                        Copyright © 2014 <a href="#">Thaihungport.com</a>
                        Mọi thông tin lấy từ Website này vui lòng ghi rõ nguốn Thaihungport.com, Nghiêm cấm mọi hành vi sao chép. ♔
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

</div>
<?php wp_footer();?>
</body>
</html>