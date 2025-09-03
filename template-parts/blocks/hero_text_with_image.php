<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$text_color = esc_attr(get_sub_field('text_color'));
$text_image_txt = get_sub_field('text_image_txt');
$text_image_img = get_sub_field('text_image_img');
?>
<section id="hero-section" class="hero_text-with-image <?php echo $background_color; ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-sm-12" style="padding: 0px;">
                <?php if ($text_image_img): ?>
                    <div class="text_image__container">
                        <img src="<?php echo esc_url($text_image_img['url']); ?>"
                            alt="<?php echo esc_attr($text_image_img['alt']); ?>" />
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-1 col-sm-2"></div>
            <div class="col-lg-4 col-sm-8 d-flex align-items-center">
                <div class="text_image">
                    <?php
                    if ($text_image_txt):
                        echo $text_image_txt;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="arrow-container">
        <a href="#category-section" class="scroll-down-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                <path d="M24 40 8 24l2.1-2.1 12.4 12.4V8h3v26.3l12.4-12.4L40 24Z" />
            </svg>
        </a>
    </div>
</section>