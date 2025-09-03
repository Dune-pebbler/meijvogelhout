<?php
get_header();

$args = array(
    'post_type' => 'post', // Use 'post' for blog posts or change to your custom post type
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'date'
);

$posts_query = new WP_Query($args);

if ($posts_query->have_posts()): ?>
    <section class="blog-cards">
        <div class="container">
            <div class="row">
                <?php
                while ($posts_query->have_posts()):
                    $posts_query->the_post();
                    ?>
                    <div class="col-12 col-lg-6">
                        <div class="blog-card">
                            <a href="<?php the_permalink(); ?>" class="post-card">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="card-image">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'featured-image')); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card-title">
                                    <h2>
                                        <?php the_title(); ?>
                                    </h2>
                                    <p>Read more about <?php the_title(); ?></p>
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
    <p>No posts found.</p>
<?php endif; ?>
<?php get_footer(); ?>