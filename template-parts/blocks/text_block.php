<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$text_color = esc_attr(get_sub_field('text_color'));
$text_block = get_sub_field('text_block');
?>

<section class="text_block <?php echo $background_color; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-3 "></div>
            <div class="col-md-6 col-sm-12 h2-big">
                <div class="text-content">
                    <?php
                    if ($text_block):
                        echo $text_block;
                    else:
                        echo '<p>No text content available.</p>';
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>