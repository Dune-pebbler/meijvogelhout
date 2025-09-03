<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="text_image">
                <?php if (get_field('text_image_title')): ?>
                    <h1>
                        <?php the_field('text_image_title'); ?>
                    </h1>
                <?php endif; ?>

                <?php if (get_field('text_image_txt')): ?>
                    <p>
                        <?php the_field('text_image_txt'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-6">
            <?php if (get_field('text_image_img')): ?>
                <img src="<?php echo the_field('text_image_img'); ?>" alt="alt-text"
                    style="object-fit: cover; width: 100%; height: 100%;">
            <?php endif; ?>
        </div>
    </div>
</div>