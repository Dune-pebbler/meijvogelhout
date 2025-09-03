<?php
$gmaps_txt = get_sub_field('gmaps_txt');
$gmaps_shortcode = get_Sub_field('gmaps_shortcode');
?>
<section class="gmaps">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-sm-2"></div>
            <div class="col-lg-4 col-sm-8 d-flex align-items-center">
                <div class="gmaps-txt__container">
                    <?= $gmaps_txt; ?>
                </div>
            </div>
            <div class="col-lg-1 col-sm-2"></div>
            <div class="col-lg-6 col-sm-12 p-0">
                <div class="gmaps-shortcode__container">
                    <?= $gmaps_shortcode; ?>
                </div>
            </div>
        </div>
    </div>
</section>