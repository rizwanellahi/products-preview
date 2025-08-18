<?php

/* Custom Post Type Start */
function create_posttype_Menu()
{
    $supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'custom-fields', // custom fields
        // 'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Menu', 'plural'),
        'singular_name' => _x('Menu', 'singular'),
        'menu_name' => _x('Menu', 'admin menu'),
        'name_admin_bar' => _x('Menu', 'admin bar'),
        'add_new' => _x('Add New Menu', 'add new'),
        'add_new_item' => __('Add New Menu'),
        'new_item' => __('New Menu'),
        'edit_item' => __('Edit Menu'),
        'view_item' => __('View Menu'),
        'all_items' => __('All Menu'),
        'search_items' => __('Search Menu'),
        'not_found' => __('No Menu found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'Menu', 'with_front' => false),
        'has_archive' => false,
        'hierarchical' => false,
        'taxonomies' => array('category', 'post_tag'),
        'menu_icon' => 'dashicons-food',
    );
    register_post_type('restaurant_menu', $args);
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype_Menu');
/* Custom Post Type End */

