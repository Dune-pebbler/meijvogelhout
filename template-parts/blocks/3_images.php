<?php

$background_color = get_sub_field('background_color');
$background_color = isset($background_color) ? esc_attr($background_color) : '';

$show_white_block = get_sub_field('show_color-block');

$color_color_block = get_sub_field('color_color-block');
$color_color_block = isset($color_color_block) ? esc_attr($color_color_block) : '';

$image_left = get_sub_field('image_left');
$image_mid = get_sub_field('image_mid');
$image_right = get_sub_field('image_right');


if ($image_left || $image_mid || $image_right): ?>
    <section class="three-images" style="background-color: <?php echo $background_color; ?>;">
        <div class="container-fluid">
            <?php if ($show_white_block && $color_color_block): ?>
                <div class="white-block" style="background-color: <?php echo $color_color_block; ?>;"></div>
            <?php endif; ?>
            <div class="row">
                <?php if (!empty($image_left)): ?>
                    <div class="col-12 col-lg-4">
                        <img src="<?php echo esc_url($image_left['url']); ?>"
                            alt="<?php echo esc_attr($image_left['alt'] ?? ''); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($image_mid)): ?>
                    <div class="col-12 col-lg-4">
                        <img src="<?php echo esc_url($image_mid['url']); ?>"
                            alt="<?php echo esc_attr($image_mid['alt'] ?? ''); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($image_right)): ?>
                    <div class="col-12 col-lg-4">
                        <img src="<?php echo esc_url($image_right['url']); ?>"
                            alt="<?php echo esc_attr($image_right['alt'] ?? ''); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>