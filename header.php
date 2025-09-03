<?php
$header_logo = get_field('header_logo', 'option');
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KZ9DMQK');
    </script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/ipa5yny.css">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KZ9DMQK" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header>
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-4 header-logo">
                    <div class="nav__logo-container d-flex justify-center" style="padding: 10px 0px;">
                        <a href="/" title="Home">
                            <?php
                            if ($header_logo && isset($header_logo['url'])): ?>
                                <img src="<?php echo esc_url($header_logo['url']); ?>" alt="50 Jaar Logo">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-8 header-content">
                    <div class="nav__container">
                        <div class="nav__menu-container">
                            <div class="nav__menu d-flex">
                                <?php
                                wp_nav_menu([
                                    'theme_location' => 'primary',
                                    'menu_class' => 'primary-nav',
                                    'container' => 'wrapper',
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="overlay">
                        <div class="nav__menu" style="display: flex;">
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                'menu_class' => 'primary-nav',
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="mobile-nav-container">
                        <div class="stripe"></div>
                        <div class="stripe"></div>
                        <div class="stripe"></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Search overlay (outside the grid system) -->
        <div class="search-overlay">
            <div class="search-overlay-content">
                <div class="search-close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
                <div class="search-form-container">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="search-field" placeholder="Zoeken..."
                            value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="search-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>