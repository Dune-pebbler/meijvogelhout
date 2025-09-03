<?php
// Check if there are slides in the repeater
if (have_rows('hero_slider_repeater')):
    ?>

    <section class="hero">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="hero-banner owl-carousel">
                        <?php
                        // Loop through each slide in the repeater
                        while (have_rows('hero_slider_repeater')):
                            the_row();
                            // Get slide fields
                            $overlay_text = get_sub_field('slide_overlay_text');
                            $hero_background_img = get_sub_field('slide_background_img');
                            ?>
                            <div class="item">
                                <?php if ($hero_background_img): ?>
                                    <img src="<?php echo esc_url($hero_background_img['url']); ?>"
                                        alt="<?php echo esc_attr($hero_background_img['alt']); ?>" />
                                <?php endif; ?>
                                <?php
                                $overlay_color = get_sub_field('overlay_color');
                                $overlay_rgba = $overlay_color ? hex_to_rgba($overlay_color, 0.75) : 'rgba(0, 0, 0, 0.25)';
                                ?>
                                <div class="hero__banner-overlay" style="background-color: <?= esc_attr($overlay_rgba); ?>">

                                    <div class="hero__overlay-text big-h1">
                                        <?php echo $overlay_text; ?>
                                    </div>

                                    <div class="hero_slider_button-container">
                                        <?php $hero_slider_button = get_sub_field('hero_slider_btn'); ?>
                                        <?php if ($hero_slider_button): ?>
                                            <a class="btn btn_slider"
                                                href="<?= $hero_slider_button['url']; ?>"><?= $hero_slider_button['title']; ?></a>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>