</main>
<footer>
    <?php
    $footer_contact = get_field('footer_contact', 'option');
    $header_logo = get_field('header_logo', 'option');
    $mib = get_field('mib_groep', 'option');
    $socials = get_field('socials_groep', 'option');
    $footer_banner = get_field('footer-banner_txt', 'option');
    $button_group = get_field('button_group', 'option');

    ?>
    <?php
    $hide_footer_banner = ($_SERVER['REQUEST_URI'] === '/contactpagina/');
    ?>

    <?php if (isset($footer_banner) || (isset($button_group['button_url']['url'], $button_group['button_url']['title']))): ?>
        <section class="footer-banner" <?= $hide_footer_banner ? 'style="display: none;"' : '' ?>>
            <?php if (isset($footer_banner)): ?>
                <h2><?= $footer_banner ?></h2>
            <?php endif; ?>

            <?php if (isset($button_group['button_url']['url'], $button_group['button_url']['title'])): ?>
                <a class="btn <?= isset($button_group['button_color']) ? $button_group['button_color'] : '' ?>"
                    href="<?= $button_group['button_url']['url'] ?>">
                    <?= $button_group['button_url']['title'] ?>
                </a>
            <?php endif; ?>
        </section>
    <?php endif; ?>



    <section class="main-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="col-container">
                        <div class="footer_logo-container">
                            <div class="nav__logo-container d-flex justify-center"
                                style="padding: 10px 0px; flex-direction:column;">
                                <a href="/" title="Home">
                                    <?php
                                    if ($header_logo && isset($header_logo['url'])): ?>
                                        <img src="<?php echo esc_url($header_logo['url']); ?>" alt="50 Jaar Logo">
                                    <?php endif; ?>
                                </a>
                                <a target="_blank"
                                    href="https://woonspecialist.nl/winkels/meijvogelhout-katwijk-aan-zee/"><img
                                        src="<?php echo get_template_directory_uri(); ?>/images/De-Woonspecialist-Meijvogel-Hout.png"
                                        alt="De Woonspecialist Meijvogel Hout" style="height:70%"></a>
                            </div>
                        </div>
                        <div class="footer-menus">
                            <div class="footer-1">
                                <?php
                                if (has_nav_menu('footer-1')) {
                                    wp_nav_menu([
                                        'theme_location' => 'footer-1',
                                        'menu_class' => 'footer-menu footer-menu-1',
                                        'container' => 'nav',
                                        'container_class' => 'footer-menu-container',
                                    ]);

                                }
                                ?>
                            </div>
                            <div class="footer-2">
                                <?php
                                if (has_nav_menu('footer-2')) {
                                    wp_nav_menu([
                                        'theme_location' => 'footer-2',
                                        'menu_class' => 'footer-menu footer-menu-2',
                                        'container' => 'nav',
                                        'container_class' => 'footer-menu-container',
                                    ]);
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-2"></div>
                <?php
                if ($footer_contact):
                    ?>
                    <div class="col-lg-5" style="color: white;">
                        <div class="lower-footer d-flex justify-around">
                            <div class="contact-content">
                                <?= $footer_contact; ?>
                            </div>
                            <div class="mib-socials-container ">
                                <div class="mib">
                                    <?= $mib['mib_title'] ?>
                                    <a target="_blank" href="https://meijvogelinbraakbeveiliging.nl"><img
                                            src="<?= esc_url($mib['mib_logo']['url']) ?>" alt="Logo"></a>
                                </div>
                                <div class="socials">
                                    <?= $socials['socials_title']; ?>
                                    <div class="social-images">
                                        <a href="<?= $socials['instagram']['instagram_link'] ?>">
                                            <img src="<?= $socials['instagram']['instagram_logo']['url'] ?>">
                                        </a>
                                        <a href="<?= $socials['facebook']['facebook_link'] ?>">
                                            <img src="<?= $socials['facebook']['facebook_logo']['url'] ?>">
                                        </a>
                                        <a href="<?= $socials['linkedin']['linkedin_link'] ?>">
                                            <img src="<?= $socials['linkedin']['linkedin_logo']['url'] ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <div class="bottom-footer">
        <div class="container">
            <div class="col-12">
                <a class="copyright" href="#">&copy; <?= date("Y"); ?> Meijvogelhout, alle rechten voorbehouden |</a>
                <a href="<?= get_privacy_policy_url(); ?>"> Privacy Policy | </a>
                <a href="https://dunepebbler.nl" target="_blank">Website: Dune Pebbler</a>

            </div>


        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>