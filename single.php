<?php
// Check if ACF is active
if (!function_exists('get_field')) {
    return;
}

// Setup blog posts query
$posts_query = new WP_Query([
    'post_type' => 'post',
    'orderby' => 'rand',
    'posts_per_page' => 3,
    'post__not_in' => [get_the_ID()]
]);

get_header();
?>

<section class="blog-header">
    <div class="container">
        <div class="row justify-center">
            <div class="col-12 col-lg-6">
                <div class="text-container">
                    <h1><?php echo esc_html(get_the_title()); ?></h1>

                    <em>
                        <p class="post-date text-right">Gepubliceerd op: <?php echo esc_html(get_the_date('d-m-Y')); ?>
                        </p>
                    </em>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <p><?php the_content(); ?>
                </p>
            </div>
        </div>
    </div>
</section>


<section class="images">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="image-container">
                    <div class="image">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('full', ['class' => 'img-fluid', 'loading' => 'lazy']); // You can change 'full' to any size like 'medium', 'large', etc.
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="text_block">
    <div class="container">
        <div class="row justify-center">

            <div class="col-md-6 col-sm-12 h2-big">
                <div class="text-content">
                    <h2 class="d-flex justify-center">Overige blogs</h2>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="blog-cards">
    <div class="container">
        <div class="row">
            <?php
            if ($posts_query->have_posts()):
                while ($posts_query->have_posts()):
                    $posts_query->the_post();
                    ?>
                    <div class="col-12 col-lg-4">
                        <div class="blog-card">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="post-card">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="card-image">
                                        <?php the_post_thumbnail('full', ['class' => 'featured-image']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card-title">
                                    <h2><?php echo esc_html(get_the_title()); ?></h2>

                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section><?php get_footer(); ?>