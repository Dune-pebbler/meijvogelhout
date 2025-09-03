<?php
$images = get_sub_field('gallery');
?>
<div class="container">
    <div class="row" style="margin-top: -70px;">
        <?php
        $images = get_sub_field('gallery');

        if ($images):
            foreach ($images as $image):
                ?>
                <div class="col-12 col-lg-4 gallery">
                    <div class="image-container">
                        <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery"
                            data-caption="<?php echo esc_attr($image['alt']); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                                class="img-fluid" loading="lazy">
                        </a>
                    </div>
                </div>
                <?php
            endforeach;
        endif;
        ?>
    </div>
</div>