<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php');

/*
Show less info to users on failed login for security.
(Will not let a valid username be known.)
*/
function show_less_login_info()
{
    return "<strong>ERROR</strong>: Stop guessing!";
}
add_filter('login_errors', 'show_less_login_info');
/*
Do not generate and display WordPress version
*/

/*------------------------------------------------------*/
/* Remove wp-json API
/*------------------------------------------------------*/
// add_filter('rest_authentication_errors', 'disable_rest_api');
// function disable_rest_api($access)
// {
//     return new WP_Error('rest_disabled', __('The WordPress REST API has been disabled.'), array('status' => rest_authorization_required_code()));
// }


/*------------------------------------------------------*/
/* REMOVE ADMIN MENUS
/*------------------------------------------------------*/
// add_action('admin_menu', 'remove_admin_menu');
// function remove_admin_menu()
// {
//     remove_menu_page('edit.php');
//     remove_menu_page('edit-comments.php'); // Comments
//     remove_menu_page('themes.php'); // Appearance
//     remove_menu_page('plugins.php'); // Plugins
//     remove_menu_page('users.php'); // Users
//     remove_menu_page('tools.php'); // Tools
//     remove_menu_page('options-general.php'); // Settings
//     remove_menu_page('edit.php?post_type=qr');
//     remove_menu_page('zci_settings');
//     remove_menu_page('edit.php?post_type=page');
// }

function remove_admin_menu_for_non_admins()
{
    if (!current_user_can('manage_options')) {
        remove_menu_page('edit.php'); // Posts
        remove_menu_page('edit-comments.php'); // Comments
        remove_menu_page('themes.php'); // Appearance
        remove_menu_page('plugins.php'); // Plugins
        remove_menu_page('users.php'); // Users
        remove_menu_page('tools.php'); // Tools
        remove_menu_page('options-general.php'); // Settings
        remove_menu_page('edit.php?post_type=qr'); // Custom Post Type: QR
        remove_menu_page('zci_settings'); // Custom Plugin Settings
        remove_menu_page('edit.php?post_type=page'); // Pages
    }
}
add_action('admin_menu', 'remove_admin_menu_for_non_admins');

function remove_admin_bar_new_option($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', 'remove_admin_bar_new_option', 999);

/*------------------------------------------------------*/
/* REMOVE ACF
/*------------------------------------------------------*/
// add_filter('acf/settings/show_admin', '__return_false');
/*------------------------------------------------------*/
/* REMOVE DASBOARD WIDGETS HOME
/*------------------------------------------------------*/

function remove_dashboard_widgets()
{
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

/*------------------------------------------------------*/
/* REMOVE Admin Bar
/*------------------------------------------------------*/
add_filter('show_admin_bar', '__return_false');