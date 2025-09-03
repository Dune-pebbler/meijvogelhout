<?php
defined("ABSPATH") || die("-1");

# DEFINES
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_TD', sanitize_title(get_bloginfo("title")));

# REQUIRES
// include("shortcodes/shortcodes.php");

# ACTIONS
add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
// add_action('wp_ajax_filter_projects', 'filter_projects');
// add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

# FILTERS
add_filter('wp_page_menu_args', 'home_page_menu_args');
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'add_image_responsive_class');
add_filter('upload_mimes', 'cc_mime_types');
add_filter('use_block_editor_for_post', '__return_false');
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

# THEME SUPPORTS
add_theme_support('menus');
add_theme_support('post-thumbnails'); // array for post-thumbnail support on certain post-types.
add_theme_support('woocommerce'); // array for post-thumbnail support on certain post-types.

# IMAGE SIZES
add_image_size('default-thumbnail', 128, 128, true); // true: hard crop or empty if soft crop

set_post_thumbnail_size(128, 128, true);

# FUNCTIONS
register_nav_menus(array(
  'primary' => __('Primary Menu', THEME_TD),
  'footer-1' => __('Footer 1 Menu', THEME_TD),
  'footer-2' => __('Footer 2 Menu', THEME_TD),
));


function theme_enqueue_styles()
{
  wp_enqueue_style('fancybox-css', get_template_directory_uri() . "/assets/fancybox/jquery.fancybox.min.css");
  wp_enqueue_style('owl.carousel.min.css', get_template_directory_uri() . "/assets/owlcarousel/owl.carousel.min.css");
  wp_enqueue_style('owl.carousel.default.theme.min.css', get_template_directory_uri() . "/assets/owlcarousel/owl.theme.default.min.css");
  wp_enqueue_style('bootstrap-grid', get_template_directory_uri() . "/stylesheets/bootstrap-grid.css");
  wp_enqueue_style('styles-main', get_template_directory_uri() . "/stylesheets/style.css", [], filemtime(get_template_directory() . "/stylesheets/style.css"));
}

function theme_enqueue_scripts()
{
  wp_enqueue_script('owl.carousel.min.js', get_template_directory_uri() . "/assets/owlcarousel/owl.carousel.min.js", ['jquery'], '1.0.0', true);

  // Rename handle here
  wp_enqueue_script('fancybox-js', get_template_directory_uri() . "/assets/fancybox/jquery.fancybox.min.js", ['jquery'], '1.0.0', true);

  // Make main.js depend on fancybox-js and jquery
  wp_enqueue_script('js-main', get_template_directory_uri() . "/js/main.js", ['jquery', 'fancybox-js'], filemtime(get_template_directory() . "/js/main.js"), true);
}



function my_acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/acf';
  return $path;
}
function my_acf_json_load_point($paths)
{
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/acf';
  return $paths;
}
function home_page_menu_args($args)
{
  $args['show_home'] = true;
  return $args;
}
function remove_thumbnail_dimensions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}
function remove_width_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
  return $html;
}
function add_image_responsive_class($content)
{
  global $post;
  $pattern = "/<img(.*?)class=\"(.*?)\"(.*?)>/i";
  $replacement = '<img$1class="$2 img-responsive"$3>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
function ds_admin_theme_style()
{
  if (!current_user_can('manage_options')) {
    echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';
  }
}
// Method 1: Filter.
function my_acf_google_map_api($api)
{
  $api['key'] = '';
  return $api;
}

# Random code
// add editor the privilege to edit theme
// get the the role object
$role_object = get_role('editor');
// add $cap capability to this role object
$role_object->add_cap('edit_theme_options');

// if (function_exists('acf_add_options_sub_page')) {
//   acf_add_options_page();
//   acf_add_options_sub_page('Footer');
//   acf_add_options_sub_page('Header');
//   acf_add_options_sub_page('Globale Opties');
//   acf_add_options_sub_page('Socials');
//   //     acf_add_options_sub_page( 'Side Menu' );
// }

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Theme General Settings', // Title of the options page
    'menu_title' => 'Theme Settings',        // Title in the WordPress admin menu
    'menu_slug' => 'theme-settings',        // Slug for the page URL
    'capability' => 'edit_posts',            // Capability required to access
    'redirect' => false,                   // Set to false to show options page content
  ));
}
function add_search_icon_to_menu($items, $args)
{
  if ($args->theme_location === 'primary') {
    $search_icon = '<li class="menu-item search-icon">
          <a href="#" class="search-toggle"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
          </a>
      </li>';
    $items .= $search_icon;
  }
  return $items;
}
add_filter('wp_nav_menu_items', 'add_search_icon_to_menu', 10, 2);
add_action('wp_ajax_load_more_posts', 'load_more_posts_ajax');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_ajax');

function load_more_posts_ajax()
{
  // Sanitize and fetch page number
  $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 9,
    'paged' => $page,
    'order' => 'DESC',
    'orderby' => 'date'
  );

  $query = new WP_Query($args);

  if ($query->have_posts()):
    ob_start(); // Start capturing output
    while ($query->have_posts()):
      $query->the_post(); ?>
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
    echo ob_get_clean(); // Output everything at once
  endif;

  wp_die(); // Required to stop further execution
}

add_action('wp_ajax_load_more_posts', 'load_more_posts_ajax');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_ajax');

// Enqueue and localize script
function enqueue_main_js()
{
  wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', [], null, true);

  // Determine the current page
  $current_page = max(1, get_query_var('paged'));

  // Localize script with necessary data
  wp_localize_script('main-js', 'blogLoadConfig', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'maxPages' => get_max_pages_for_blog(),
    'currentPage' => $current_page
  ]);
}

add_action('wp_enqueue_scripts', 'enqueue_main_js');

// Helper to calculate total pages
function get_max_pages_for_blog()
{
  $query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 9
  ]);
  return $query->max_num_pages;
}
function hex_to_rgba($hex, $alpha = 1.0)
{
  $hex = str_replace('#', '', $hex);

  if (strlen($hex) === 3) {
    $r = hexdec(str_repeat($hex[0], 2));
    $g = hexdec(str_repeat($hex[1], 2));
    $b = hexdec(str_repeat($hex[2], 2));
  } else {
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
  }

  return "rgba($r, $g, $b, $alpha)";
}
// Recursively extract all strings from ACF fields
function flatten_acf_fields($fields)
{
  $content = '';
  foreach ($fields as $value) {
    if (is_array($value)) {
      // Dive deeper into flexible/repeater fields
      $content .= ' ' . flatten_acf_fields($value);
    } elseif (is_string($value)) {
      $content .= ' ' . $value;
    }
  }
  return $content;
}
?>