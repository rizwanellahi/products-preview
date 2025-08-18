<?php
/**
 * category.php
 * 
 * Template for displaying restaurant_menu items by WP default categories 
 */

get_header();

// 1) Get the current category object and build a custom query.
$category_obj = get_queried_object();
$category_slug = $category_obj->slug;

$country_symbol = get_field('country_symbol', 'option');

$theme_background_color = get_field('theme_background_color', 'option');

$args = [
    'post_type' => 'restaurant_menu',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'DESC',
    'tax_query' => [
        [
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $category_slug,
        ],
    ],
];
$query = new WP_Query($args);
$posts_array = $query->have_posts() ? $query->posts : [];

?>
<div id="restaurant-menu" style="background-color:<?php echo $theme_background_color; ?>">

    <?php get_template_part('page-templates/menu-parts/header'); // Your custom header part ?>

    <div class="menu-list relative z-50">

        <?php
        /**
         * Partial: Navigation
         * Pass $posts_array so the partial can create anchor links, etc.
         */
        get_template_part(
            'template-parts/menu/nav',
            null,
            [
                'posts_array' => $posts_array,
            ]
        );
        ?>

        <!-- ========== MAIN CONTENT ========== -->
        <main id="main-content" class="page-sections">
            <div class="menu-container mx-auto px-4 lg:px-4 pt-6 max-w-4xl lg:max-w-7xl bg-white"
                style="background-color:<?php echo $theme_background_color; ?>">

                <?php
                /**
                 * Partial: Menu Content
                 * Pass the same $posts_array to loop over them again 
                 * and display flexible fields, two-column layout, modals, etc.
                 */
                get_template_part(
                    'template-parts/menu/content',
                    null,
                    [
                        'posts_array' => $posts_array,
                        'country_symbol' => $country_symbol,
                    ]
                );
                ?>

            </div> <!-- .menu-container -->
        </main> <!-- #main-content -->
    </div> <!-- .menu-list -->
</div> <!-- #restaurant-menu -->

<?php
/**
 * Partial: Menu Categories Modal
 * This is the popup listing each post (with item counts)
 */
get_template_part(
    'template-parts/menu/categories-modal',
    null,
    [
        'posts_array' => $posts_array,
    ]
);

// Additional template parts or partials if needed
get_template_part('page-templates/menu-parts/info');
get_template_part('page-templates/menu-parts/footer');
get_template_part('page-templates/menu-parts/primary-color');

get_footer();
