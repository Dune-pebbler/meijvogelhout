<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$reverse_layout = get_sub_field('reverse_layout');
$text_image_txt = get_sub_field('text_image_txt');
$text_image_img = get_sub_field('text_image_img');
$image_link = get_sub_field('image_link');

// Add the new field to control visibility on mobile
$display_on_mobile = get_sub_field('display_p_mobile'); // Assuming it's a true/false field

// Handle button group safely
$button_group = get_sub_field('text_image_group');
$show_button = !empty($button_group['button_toggle']);
$button_url_data = !empty($button_group['button_url']) && is_array($button_group['button_url']) ? $button_group['button_url'] : null;

$button_url = $button_url_data ? esc_url($button_url_data['url']) : '';
$button_title = $button_url_data ? esc_html($button_url_data['title']) : '';
$button_target = $button_url_data && !empty($button_url_data['target']) ? esc_attr($button_url_data['target']) : '_self';
$button_style = !empty($button_group['btn_color']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $button_group['btn_color']) : '';

// Handle image link safely
$image_link_url = !empty($image_link['url']) ? esc_url($image_link['url']) : '';
?>

<section class="text-with-image <?php echo $background_color; ?>">
    <div class="container-fluid">
        <div class="row<?php echo $reverse_layout ? ' reverse' : ''; ?>">
            <!-- Text Section -->
            <div class="col-lg-1 col-sm-2"></div>
            <div class="col-lg-4 col-sm-8 d-flex align-items-center justify-content-center">
                <div class="text_image <?php echo $display_on_mobile ? 'mobile-show' : ''; ?>">
                    <?php if (!empty($text_image_txt)): ?>
                        <div class="text-image-content">
                            <?php echo wp_kses_post($text_image_txt); ?>
                        </div>
                    <?php else: ?>
                        <p>No text content available.</p>
                    <?php endif; ?>

                    <?php if ($show_button && $button_url): ?>
                        <div class="button-wrapper mt-3">
                            <a href="<?php echo $button_url; ?>" class="btn <?php echo esc_attr($button_style); ?>"
                                target="<?php echo $button_target; ?>">
                                <?php echo $button_title; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-1 col-sm-2"></div>

            <!-- Image Section -->
            <div class="col-lg-6 col-sm-12 p-0">
                <?php if (!empty($text_image_img['url'])): ?>
                    <div class="text_image__container">
                        <?php if ($image_link_url): ?>
                            <a href="<?php echo $image_link_url; ?>" target="_blank">
                            <?php endif; ?>

                            <img src="<?php echo esc_url($text_image_img['url']); ?>"
                                alt="<?php echo esc_attr($text_image_img['alt']); ?>">

                            <?php if ($image_link_url): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p>No image available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>