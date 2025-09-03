<?php

/*
 * Template Name: product-categories
 */

get_header();

$args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent' => get_the_ID(),
    'order' => 'ASC',
    'orderby' => 'menu_order title'
);

$child_pages = new WP_Query($args);

if ($child_pages->have_posts()): ?>
    <section class="categorie_cards">
        <div class="container">
            <div class="row">
                <?php
                while ($child_pages->have_posts()):
                    $child_pages->the_post();
                    ?>
                    <div class="col-12 col-lg-6">
                        <div class="categorie-card">
                            <a href="<?php the_permalink(); ?>" class="child-page-card">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="card-image">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'featured-image')); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card-title">
                                    <h2>
                                        <?php the_title(); ?>

                                    </h2>
                                    <?php
                                    $cp_excerpt = get_field('child_page_excerpt');
                                    ?>
                                    <?php if ($cp_excerpt): ?>
                                        <p><?= ($cp_excerpt); ?></p>
                                    <?php else: ?>
                                        <p>Meer over <?= get_the_title(); ?></p>
                                    <?php endif; ?>

                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <p>No child pages found.</p>
<?php endif; ?>
<?php get_footer(); ?>