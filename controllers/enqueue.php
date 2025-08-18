<?php
/**
 * Dequeue jQuery Migrate script in WordPress.
 */

function assets_enqueues()
{

    $url_template = content_url();

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    // CSS with file modification time as version
    $css_file = get_template_directory() . '/build/css/app.css';
    $css_version = file_exists($css_file) ? filemtime($css_file) : '1.0';  // Check if file exists before using filemtime

    wp_enqueue_style('template-css', $url_template . '/themes/logix360-menu-tablet/build/css/app.css', array(), $css_version);

    // JS files with file modification time as version
    $app_js_file = get_template_directory() . '/build/js/app.js';  // Removed the duplicate 'themes/logix360-menu-tablet'
    $app_js_version = file_exists($app_js_file) ? filemtime($app_js_file) : '1.0';  // Check if file exists

    wp_enqueue_script('jquery-js', $url_template . '/themes/logix360-menu-tablet/vendor/js/jquery.min.js', array(), null, true);
    wp_enqueue_script('modal-js', $url_template . '/themes/logix360-menu-tablet/vendor/js/microModal.min.js', array(), null, true);
    wp_enqueue_script('glide-js', $url_template . '/themes/logix360-menu-tablet/vendor/js/glide.min.js', array(), null, true);
    wp_enqueue_script('menu-js', $url_template . '/themes/logix360-menu-tablet/build/js/restaurant-menu.js', array(), $app_js_version, true);
    wp_enqueue_script('app-js', $url_template . '/themes/logix360-menu-tablet/build/js/app.js', array(), $app_js_version, true);

}

add_action('wp_enqueue_scripts', 'assets_enqueues');

function remove_wp_block_library_styles()
{
    // Remove an unused CSS file
    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wp-block-library');

    wp_dequeue_style('dashicons');
    wp_deregister_style('dashicons');

    wp_dequeue_style('jquery-intl-tel-input');
    wp_deregister_style('jquery-intl-tel-input');

    wp_dequeue_style('trp-language-switcher-style');
    wp_deregister_style('trp-language-switcher-style');

    // Remove an unused JavaScript file
    // wp_dequeue_script('everest-forms-survey-polls-quiz-script');
    // wp_deregister_script('everest-forms-survey-polls-quiz-script');
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_styles', 100);