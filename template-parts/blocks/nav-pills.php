<?php
$current_page_id = get_the_ID();
$parent_id = wp_get_post_parent_id($current_page_id);

// If we have a parent page, get all its children (including current page)
if ($parent_id) {
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_parent' => $parent_id,
        'order' => 'ASC',
        'orderby' => 'menu_order title'
    );

    $sibling_pages = new WP_Query($args);

    if ($sibling_pages->have_posts()): ?>
        <section class="nav-pills">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="nav-pills__wrapper">
                            <?php
                            while ($sibling_pages->have_posts()):
                                $sibling_pages->the_post();
                                $is_current = (get_the_ID() == $current_page_id) ? 'nav-pills__item--active' : '';
                                ?>
                                <a href="<?php the_permalink(); ?>" class="nav-pills__item btn_lg_bg  <?php echo $is_current; ?>">
                                    <?php the_title(); ?>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php wp_reset_postdata();
    endif;
}
?>