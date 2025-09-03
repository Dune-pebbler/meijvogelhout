<?php
// Define all ACF fields at the top
$logo_slider_logos = get_sub_field('logo_slider_logos');
$slider_txt = get_sub_field('slider_txt');
?>
<section class="logo_slider">
    <div class="container-fluid">
        <?php if (!empty($slider_txt)): ?>
            <div class="logo__slider-text">
                <h2><?php echo wp_kses_post($slider_txt); ?></h2>
            </div>
        <?php endif; ?>

        <?php if (!empty($logo_slider_logos)): ?>
            <div class="owl-carousel logo-carousel">
                <?php foreach ($logo_slider_logos as $image): ?>
                    <?php if (!empty($image['logo_slider_logo']['url'])): ?>
                        <div class="logo_slider__img-container">
                            <img src="<?php echo esc_url($image['logo_slider_logo']['url']); ?>"
                                alt="<?php echo esc_attr($image['logo_slider_logo']['alt'] ?? ''); ?>" class="img-fluid">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>