<?php
/* --- CPT: Projects --- */
function create_posttype_projects()
{
    $supports = array('title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions', 'post-formats');
    $labels = array(
        'name' => _x('Projects', 'plural'),
        'singular_name' => _x('Project', 'singular'),
        'menu_name' => _x('Projects', 'admin menu'),
        'name_admin_bar' => _x('Project', 'admin bar'),
        'add_new' => _x('Add New', 'project'),
        'add_new_item' => __('Add New Project'),
        'new_item' => __('New Project'),
        'edit_item' => __('Edit Project'),
        'view_item' => __('View Project'),
        'all_items' => __('All Projects'),
        'search_items' => __('Search Projects'),
        'not_found' => __('No Projects found.'),
    );

    $args = array(
        'supports'     => $supports,
        'labels'       => $labels,
        'public'       => true,
        'query_var'    => true,
        // IMPORTANT: include taxonomy placeholder
        'has_archive' => 'projects',   // force archive URL = /projects/
        'rewrite'     => [
            'slug'       => 'projects/%project_category%', // still used for singles
            'with_front' => false,
        ],
        'hierarchical' => false,
        'menu_icon'    => 'dashicons-portfolio',
        'show_in_rest' => true,
    );

    register_post_type('project', $args);
}
add_action('init', 'create_posttype_projects');


/* --- Taxonomy: Project Categories --- */
function create_project_taxonomy()
{
    $labels = array(
        'name'              => _x('Project Categories', 'taxonomy general name'),
        'singular_name'     => _x('Project Category', 'taxonomy singular name'),
        'search_items'      => __('Search Project Categories'),
        'all_items'         => __('All Project Categories'),
        'parent_item'       => __('Parent Category'),
        'parent_item_colon' => __('Parent Category:'),
        'edit_item'         => __('Edit Project Category'),
        'update_item'       => __('Update Project Category'),
        'add_new_item'      => __('Add New Project Category'),
        'new_item_name'     => __('New Project Category Name'),
        'menu_name'         => __('Project Categories'),
    );

    // Enable pretty term URLs under /projects/
    $args = array(
        'hierarchical'       => true,
        'labels'             => $labels,
        'show_ui'            => true,
        'show_admin_column'  => true,
        'query_var'          => 'project_category',
        'rewrite'            => array(
            'slug'         => 'projects',   // /projects/{term}
            'with_front'   => false,
            'hierarchical' => true,
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_nav_menus'  => true,
        'show_in_rest'       => true,
    );

    register_taxonomy('project_category', array('project'), $args);
}
add_action('init', 'create_project_taxonomy', 0);


/* --- Replace %project_category% in single permalinks --- */
function projects_permalink_structure($permalink, $post)
{
    if ($post->post_type !== 'project') {
        return $permalink;
    }

    // Get a category (use Yoast primary here if you want; this picks the first)
    $terms = wp_get_post_terms($post->ID, 'project_category', array('orderby' => 'term_order'));

    if (! empty($terms) && ! is_wp_error($terms)) {
        $category = $terms[0]->slug;
    } else {
        $category = 'uncategorized';
    }

    return str_replace('%project_category%', $category, $permalink);
}
add_filter('post_type_link', 'projects_permalink_structure', 10, 2);

/* --- Add rewrite rules so /projects/{category}/{post} resolves --- */
function projects_add_rewrite_rules()
{
    // Single: /projects/{category}/{post}
    add_rewrite_rule(
        '^projects/([^/]+)/([^/]+)/?$',
        'index.php?project=$matches[2]&project_category=$matches[1]',
        'top'
    );

    // Optional: paginated term archives already handled by taxonomy rewrite, but keep CPT archive too:
    // /projects (archive)
    add_rewrite_rule(
        '^projects/?$',
        'index.php?post_type=project',
        'top'
    );
}
add_action('init', 'projects_add_rewrite_rules');

/* --- (Optional) Make sure WP recognizes the %project_category% tag --- */
function projects_add_rewrite_tag()
{
    add_rewrite_tag('%project_category%', '([^&/]+)', 'project_category=');
}
add_action('init', 'projects_add_rewrite_tag');
