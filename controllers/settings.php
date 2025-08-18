<?php
/**
 * ACF PRO - Options Page
 */
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(
        array(
            'menu_title' => 'Theme Settings',
            'icon_url' => 'dashicons-admin-appearance'
        )
    );
}

/*-----------------------------------------------------------------------------------*/
/* Register Menus */
/*-----------------------------------------------------------------------------------*/
function my_theme_register_menus()
{
    register_nav_menus(array(
        'category-page' => __('Category Page', 'your-textdomain'),
        'language-switcher' => __('Language Switcher', 'your-textdomain'),
    ));
}
add_action('after_setup_theme', 'my_theme_register_menus');

//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');

// Turn off oEmbed auto discovery.
add_filter('embed_oembed_discover', '__return_false');

//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');

//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');

add_filter('rest_authentication_errors', function ($result) {
    if (!is_user_logged_in()) {
        return new WP_Error('restx_logged_out', 'Sorry, you must be logged in to make a request.', array('status' => 401));
    }
    return $result;
});

/*-----------------------------------------------------------------------------------*/
/* Minify Pages */
/*-----------------------------------------------------------------------------------*/
function wp_minify_html($html)
{
    // Only run on the front-end, not in admin
    if (is_admin()) {
        return $html;
    }
    // Remove whitespaces between tags, multiple spaces, and newlines
    $search = array(
        '/\>[^\S ]+/s',  // Remove whitespaces after tags, except space
        '/[^\S ]+\</s',  // Remove whitespaces before tags, except space
        '/(\s)+/s'       // Shorten multiple whitespace sequences
    );
    $replace = array(
        '>',
        '<',
        '\\1'
    );
    return preg_replace($search, $replace, $html);
}
function wp_html_minify_start()
{
    // Check that we’re not in the admin dashboard
    if (!is_admin()) {
        ob_start('wp_minify_html');
    }
}
add_action('template_redirect', 'wp_html_minify_start');