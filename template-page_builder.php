<?php
/*
 * Template Name: Page Builder
 */

get_header(); ?>

<?php if (have_rows('pagebuilder')): ?>
        <?php while (have_rows('pagebuilder')):
                the_row(); ?>

                <?php if (get_row_layout() === 'hero_banner'): ?>
                        <?php get_template_part('template-parts/blocks/hero_banner'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'hero_banner_slider'): ?>
                        <?php get_template_part('template-parts/blocks/hero_banner_slider'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'text_with_image'): ?>
                        <?php get_template_part('template-parts/blocks/text_with_image'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'text_block'): ?>
                        <?php get_template_part('template-parts/blocks/text_block'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'cards'): ?>
                        <?php get_template_part('template-parts/blocks/cards'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'inspiratie'): ?>
                        <?php get_template_part('template-parts/blocks/inspiration'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'hero_text_with_image'): ?>
                        <?php get_template_part('template-parts/blocks/hero_text_with_image'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'categorie_cards'): ?>
                        <?php get_template_part('template-parts/blocks/categorie_cards'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'logo_slider'): ?>
                        <?php get_template_part('template-parts/blocks/logo_slider'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === '3_images'): ?>
                        <?php get_template_part('template-parts/blocks/3_images'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'nav_pills'): ?>
                        <?php get_template_part('template-parts/blocks/nav-pills'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'gallery'): ?>
                        <?php get_template_part('template-parts/blocks/gallery'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'gmaps'): ?>
                        <?php get_template_part('template-parts/blocks/gmaps'); ?>
                <?php endif; ?>
        <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>