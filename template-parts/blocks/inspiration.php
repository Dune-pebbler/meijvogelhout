<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$inspiratie_images = get_sub_field('inspiratie_images');
$inspiratie_url = get_sub_field('btn_url');
$inspiratie_text = get_sub_field('btn_txt') ?: 'Default Text';
$button_style = get_sub_field('btn_color');
$inspiratie_title = get_sub_field('inspiratie_title');
// Ensure the URL is properly handled (whether it's a string or an array)
$url = is_array($inspiratie_url) ? esc_url($inspiratie_url['url']) : esc_url($inspiratie_url);
?>
<section class="inspiratie" style="background-color: <?php echo $background_color; ?>">
    <div class="container-fluid">
        <div class="title-container">
            <?php if ($inspiratie_title): ?>
                <h2><?= $inspiratie_title; ?></h2>
            <?php endif; ?>

        </div>
        <?php if ($inspiratie_images): ?>
            <div class="owl-carousel inspiratie-carousel">
                <?php foreach ($inspiratie_images as $image): ?>
                    <div class="inspiratie__img-container">
                        <img src="<?php echo esc_url($image['inspiratie_img']['url']); ?>"
                            alt="<?php echo esc_attr($image['inspiratie_img']['alt']); ?>" class="img-fluid">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12" style="display: flex; justify-content: center;">
                <a style="margin-top: 20px;" class="btn <?= esc_attr($button_style) ?>" href="<?= esc_url($url); ?>">
                    <?= esc_html($inspiratie_url['title']) ?>
                </a>
            </div>

        </div>
    </div>
</section>