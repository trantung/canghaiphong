<?php  while(have_posts()): the_post();?>
<div class="slider">
    <div class="container">
        <div class="content-slider container-inner">
            <?php the_content();?>
        </div>
    </div>
</div>
<?php endwhile;wp_reset_query();?>