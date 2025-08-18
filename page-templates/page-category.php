<?php

/**
 * Template Name: Category Menu
 */

get_header();

// ------------------------------
// Get categories (excluding "Uncategorized")
// ------------------------------
$categories = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false,
    'exclude' => array(1), // Replace "1" with the correct ID for "Uncategorized" if different
));

// Add images to each category if the helper exists.
if (function_exists('z_taxonomy_image_url') && !is_wp_error($categories) && !empty($categories)) {
    foreach ($categories as $key => $cat) {
        $categories[$key]->image = z_taxonomy_image_url($cat->term_id, 'large');
    }
}

// ------------------------------
// Get the "Categorized Menu" via menu locations
// ------------------------------
// $locations = get_nav_menu_locations();
// $menu_items = array();

// if (isset($locations['category-page'])) {
//     $menu_id = $locations['category-page'];
//     $menu_items = wp_get_nav_menu_items($menu_id);

//     if (function_exists('z_taxonomy_image_url') && !empty($menu_items)) {
//         foreach ($menu_items as $key => $item) {
//             // Assuming the menu item's object_id corresponds to a term ID.
//             $menu_items[$key]->image = z_taxonomy_image_url($item->object_id, 'large');
//         }
//     }
// }

// ------------------------------
// Get the "Categorized Menu" via menu locations
// ------------------------------
$locations = get_nav_menu_locations();
$menu_items = array();

if (isset($locations['category-page'])) {
    $menu_id = $locations['category-page'];
    $menu_items = wp_get_nav_menu_items($menu_id);

    if (function_exists('z_taxonomy_image_url') && !empty($menu_items)) {
        foreach ($menu_items as $key => $item) {
            // Get the term object — assuming this menu item is linked to a taxonomy term
            $term = get_term($item->object_id);

            if ($term && !is_wp_error($term)) {
                $menu_items[$key]->description = $term->description;
            } else {
                $menu_items[$key]->description = ''; // fallback
            }

            // Get image using z_taxonomy_image_url (taxonomy image plugin)
            $menu_items[$key]->image = z_taxonomy_image_url($item->object_id, 'large');
        }
    }
}

$theme_background_color = get_field('theme_background_color', 'option');

?>

<div id="restaurant-menu" class="menu-selection" style="background-color:<?php echo $theme_background_color; ?>">
    <?php get_template_part('page-templates/menu-parts/header'); ?>
    <div class="bg-white py-6 sm:py-14" style="background-color:<?php echo $theme_background_color; ?>">
        <div class="mx-auto max-w-xl px-6 lg:px-8">
            <div class="restaurant-menu-category-cards mx-auto grid max-w-2xl auto-rows-fr grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4 lg:mx-0 lg:max-w-none">
                <?php if (!empty($menu_items)): ?>
                    <?php foreach ($menu_items as $item): ?>

                        <a href="<?php echo esc_url($item->url); ?>" class="bg-gray-800 relative flex p- flex-col overflow-hidden rounded-2xl p-4 hover:opacity-75 w-auto">
                            
                            <span class="relative mt-auto text-center text-xl font-medium tracking-wider text-white">
                                <?php echo esc_html($item->title); ?>
                            </span>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($categories as $category): ?>
                        <?php
                        // Get category link
                        $category_link = get_term_link($category);
                        ?>
                        <a href="<?php echo esc_url($category->url); ?>" class="categorized_item relative isolate flex flex-col justify-center items-center overflow-hidden rounded-2xl bg-gray-200 p-20">
                            <?php if (!empty($category->image)): ?>
                                <img src="<?php echo esc_url($category->image); ?>" alt="<?php echo esc_attr($category->name); ?>"
                                    class="absolute inset-0 -z-10 size-full object-cover" />
                            <?php endif; ?>
                            <h3 class="text-2xl/8 font-medium text-white">
                                <!-- <span class="absolute inset-0"></span> -->
                                <?php echo esc_html($category->name); ?>
                            </h3>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- End Markup -->
<?php
get_template_part('page-templates/menu-parts/info');
get_template_part('page-templates/menu-parts/footer');
get_template_part('page-templates/menu-parts/primary-color');

get_footer();
