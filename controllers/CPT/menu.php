<?php
/* --- CPT: Funnels --- */
function create_posttype_funnels()
{
    $supports = array('title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions', 'post-formats');
    $labels = array(
        'name'               => _x('Funnels', 'plural'),
        'singular_name'      => _x('Funnel', 'singular'),
        'menu_name'          => _x('Funnels', 'admin menu'),
        'name_admin_bar'     => _x('Funnel', 'admin bar'),
        'add_new'            => _x('Add New', 'funnel'),
        'add_new_item'       => __('Add New Funnel'),
        'new_item'           => __('New Funnel'),
        'edit_item'          => __('Edit Funnel'),
        'view_item'          => __('View Funnel'),
        'all_items'          => __('All Funnels'),
        'search_items'       => __('Search Funnels'),
        'not_found'          => __('No Funnels found.'),
    );

    $args = array(
        'supports'      => $supports,
        'labels'        => $labels,
        'public'        => true,
        'query_var'     => true,
        // IMPORTANT: include taxonomy placeholder
        'has_archive'   => 'funnels',   // force archive URL = /funnels/
        'rewrite'       => [
            'slug'       => 'funnels/%funnel_category%', // still used for singles
            'with_front' => false,
        ],
        'hierarchical'  => false,
        'menu_icon'     => 'dashicons-portfolio',
        'show_in_rest'  => true,
    );

    register_post_type('funnel', $args);
}
add_action('init', 'create_posttype_funnels');


/* --- Taxonomy: Funnel Categories --- */
function create_funnel_taxonomy()
{
    $labels = array(
        'name'              => _x('Funnel Categories', 'taxonomy general name'),
        'singular_name'     => _x('Funnel Category', 'taxonomy singular name'),
        'search_items'      => __('Search Funnel Categories'),
        'all_items'         => __('All Funnel Categories'),
        'parent_item'       => __('Parent Category'),
        'parent_item_colon' => __('Parent Category:'),
        'edit_item'         => __('Edit Funnel Category'),
        'update_item'       => __('Update Funnel Category'),
        'add_new_item'      => __('Add New Funnel Category'),
        'new_item_name'     => __('New Funnel Category Name'),
        'menu_name'         => __('Funnel Categories'),
    );

    // Enable pretty term URLs under /funnels/
    $args = array(
        'hierarchical'       => true,
        'labels'             => $labels,
        'show_ui'            => true,
        'show_admin_column'  => true,
        'query_var'          => 'funnel_category',
        'rewrite'            => array(
            'slug'         => 'funnels',   // /funnels/{term}
            'with_front'   => false,
            'hierarchical' => true,
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_nav_menus'  => true,
        'show_in_rest'       => true,
    );

    register_taxonomy('funnel_category', array('funnel'), $args);
}
add_action('init', 'create_funnel_taxonomy', 0);


/* --- Replace %funnel_category% in single permalinks --- */
function funnels_permalink_structure($permalink, $post)
{
    if ($post->post_type !== 'funnel') {
        return $permalink;
    }

    // Get a category (use Yoast primary here if you want; this picks the first)
    $terms = wp_get_post_terms($post->ID, 'funnel_category', array('orderby' => 'term_order'));

    if (! empty($terms) && ! is_wp_error($terms)) {
        $category = $terms[0]->slug;
    } else {
        $category = 'uncategorized';
    }

    return str_replace('%funnel_category%', $category, $permalink);
}
add_filter('post_type_link', 'funnels_permalink_structure', 10, 2);

/* --- Add rewrite rules so /funnels/{category}/{post} resolves --- */
function funnels_add_rewrite_rules()
{
    // Single: /funnels/{category}/{post}
    add_rewrite_rule(
        '^funnels/([^/]+)/([^/]+)/?$',
        'index.php?funnel=$matches[2]&funnel_category=$matches[1]',
        'top'
    );

    // /funnels (archive)
    add_rewrite_rule(
        '^funnels/?$',
        'index.php?post_type=funnel',
        'top'
    );
}
add_action('init', 'funnels_add_rewrite_rules');

/* --- (Optional) Make sure WP recognizes the %funnel_category% tag --- */
function funnels_add_rewrite_tag()
{
    add_rewrite_tag('%funnel_category%', '([^&/]+)', 'funnel_category=');
}
add_action('init', 'funnels_add_rewrite_tag');