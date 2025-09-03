<?php get_header(); ?>
<section class="singular">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-6 col-lg-8">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>