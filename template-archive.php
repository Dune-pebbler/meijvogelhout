<?php
/*
 * Template Name: Blog archive
 */

get_header();
?>

<section class="text_block">
    <div class="container">
        <div class="row">
            <div class="col-md-3 "></div>
            <div class="col-md-6 col-sm-12 h2-big">
                <div class="text-content">
                    <h2 class="d-flex justify-center">blog overzicht</h2>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<section class="blog-cards">
    <div class="container">
        <div class="row" id="post-container">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 9,
                'paged' => 1,
                'order' => 'DESC',
                'orderby' => 'date'
            );

            $posts_query = new WP_Query($args);

            if ($posts_query->have_posts()):
                while ($posts_query->have_posts()):
                    $posts_query->the_post(); ?>
                    <div class="col-12 col-lg-4 blog-post">
                        <div class="blog-card">
                            <a href="<?php the_permalink(); ?>" class="post-card">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="card-image">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'featured-image')); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card-title">
                                    <h2><?php the_title(); ?></h2>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No posts found.</p>';
            endif;
            ?>
        </div>
        <div style="text-align:center; padding:20px;">
            <a class="btn btn_lg_bg" id="load-more-btn" style="padding: 10px 20px; font-size: 16px;">Meer blogs
                laden</a>
        </div>

    </div>
</section>



<?php get_footer(); ?>