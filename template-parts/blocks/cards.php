<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$show_white_block = get_sub_field('show_white-block');
$cards = get_sub_field('cards');
?>

<section class="cards" style="background-color: <?php echo $background_color; ?>;">
    <div class="container-fluid p-0">
        <?php if ($show_white_block): ?>
            <div class="white-block"></div>
        <?php endif; ?>

        <?php if ($cards && is_array($cards)): ?>
            <div class="owl-carousel cards-carousel">
                <?php foreach ($cards as $card): ?>
                    <?php
                    // Ensure $card is an array
                    if (!is_array($card)) {
                        continue;
                    }

                    $card_img = $card['card_img'] ?? null;
                    $card_text = $card['card_text'] ?? '';
                    $card_url = $card['card_url'] ?? null;

                    // Ensure card_img is an array and get the URL
                    $card_img_url = (is_array($card_img) && isset($card_img['url'])) ? $card_img['url'] : '';
                    $card_url_href = (is_array($card_url) && isset($card_url['url'])) ? $card_url['url'] : '#';
                    ?>

                    <div class="col-carousel">
                        <div class="card">
                            <a href="<?php echo esc_url($card_url_href); ?>">
                                <div class="card__image-container">
                                    <?php if (!empty($card_img_url)): ?>
                                        <img src="<?php echo esc_url($card_img_url); ?>" alt="<?php echo esc_attr($card_text); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="text_content">
                                    <?php echo wp_kses_post($card_text); ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>