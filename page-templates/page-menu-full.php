<?php

get_header();

/**
 * Get the current category object so we can build a WP_Query
 * specific to posts in this category (slug).
 */
$category_obj = get_queried_object();
$category_slug = $category_obj->slug;

// If you have a “country_symbol” option field:
$country_symbol = get_field('country_symbol', 'option');

/**
 * Build a WP_Query to get all ‘restaurant_menu’ posts
 * that belong to the *current* category being viewed.
 */
$args = [
    'post_type' => 'restaurant_menu',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'DESC',
];
$query = new WP_Query($args);
?>

<div id="restaurant-menu">
    <!-- If you have a custom header partial, include it here -->
    <?php get_template_part('page-templates/menu-parts/header'); ?>

    <div class="menu-list -mt-6 relative">
        <!-- ========== NAV SECTIONS ========== -->
        <nav class="nav-sections mx-auto max-w-2xl lg:max-w-4xl rounded-lg">
            <a href="javascript:;" data-micromodal-trigger="menu-cat" class="block" aria-label="Open item categories">
                <div class="absolute top-0 rtl:right-0 ltr:left-0 h-[99%] flex items-center z-[99] px-2">
                    <!-- Burger icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>
            </a>

            <ul class="menu ltr:ml-[2.5rem] rtl:mr-[2.5rem] mx-auto max-w-2xl lg:max-w-4xl">
                <?php if ($query->have_posts()): ?>
                    <?php
                    // Gather posts to loop twice (first pass for menu nav).
                    $posts_array = $query->posts;
                    foreach ($posts_array as $post_obj):
                        setup_postdata($post_obj);
                        $menu_title = get_the_title($post_obj);
                        ?>
                        <li class="menu-item">
                            <a class="menu-item-link text-gray-600 font-medium text-sm"
                                href="#<?php echo esc_attr($menu_title); ?>">
                                <?php echo esc_html($menu_title); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <div class="active-line"></div>
            </ul>
        </nav>
        <!-- ========== /NAV SECTIONS ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        <main id="main-content" class="page-sections">
            <div class="menu-container mx-auto max-w-2xl lg:px-4 lg:max-w-4xl bg-white">
                <?php
                /**
                 * Second pass: loop through the same restaurant_menu posts 
                 * and display flexible fields, items, etc.
                 */
                if (!empty($posts_array)):
                    foreach ($posts_array as $post_obj):
                        setup_postdata($post_obj);

                        $menu_title = get_the_title($post_obj);
                        $menu_content = apply_filters('the_content', $post_obj->post_content);
                        $restaurant_menu = get_field('restaurant_menu', $post_obj->ID);

                        // Display any “promotion_and_deals” flexible content (pictures, videos, etc.)
                        if (have_rows('promotion_and_deals', $post_obj->ID)) {
                            while (have_rows('promotion_and_deals', $post_obj->ID)) {
                                the_row();
                                $layout = get_row_layout();
                                $output = '';

                                if ($layout === 'picture') {
                                    $image = get_sub_field('image');
                                    $link = get_sub_field('link');
                                    if ($image) {
                                        $output .= '<a href="' . esc_url($link) . '" class="block rounded-2xl overflow-hidden">';
                                        $output .= '<img src="' . esc_url($image) . '" class="object-cover object-center max-h-[130px] lg:max-h-[200px] w-full" alt="Promotion">';
                                        $output .= '</a>';
                                    }
                                } elseif ($layout === 'video') {
                                    $video = get_sub_field('video');
                                    $thumbnail = get_sub_field('thumbnail');
                                    if ($video) {
                                        $output .= '<div class="block rounded-2xl overflow-hidden">';
                                        $output .= '<video muted autoplay loop playsinline poster="' . esc_url($thumbnail) . '" class="object-cover object-center max-h-[160px] lg:max-h-[300px] w-full">';
                                        $output .= '<source src="' . esc_url($video) . '" type="video/mp4">';
                                        $output .= 'Your browser does not support the video tag.';
                                        $output .= '</video>';
                                        $output .= '</div>';
                                    }
                                }

                                if (!empty($output)) {
                                    echo '<div class="promotion-container block w-full -mb-4 pt-6 lg:pt-8 px-2 lg:px-0">';
                                    echo $output;
                                    echo '</div>';
                                }
                            }
                        }

                        // If there is data in 'restaurant_menu'
                        if ($restaurant_menu && is_array($restaurant_menu)):
                            foreach ($restaurant_menu as $list):
                                // Check if “two_column” is enabled for this section
                                if (!empty($list['two_column'])):
                                    // =========================
                                    // Two-Column Layout Section
                                    // =========================
                                    ?>
                                    <div class="featured-item-box pt-10 lg:pt-14" id="<?php echo esc_attr($menu_title); ?>">
                                        <div
                                            class="mx-auto max-w-2xl lg:text-center page-section ltr:pl-4 rtl:pr-4 lg:rtl:pr-0 lg:pl-0 sm:pb-8 pb-3">
                                            <h2 class="text-3xl font-semibold sm:text-4xl">
                                                <?php echo esc_html($menu_title); ?>
                                            </h2>
                                            <?php if ($menu_content): ?>
                                                <p class="mt-6 text-lg leading-8 text-gray-600">
                                                    <?php echo wp_kses_post($menu_content); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mx-auto px-4 lg:px-6">
                                            <dl
                                                class="grid max-full grid-cols-2 gap-4 lg:gap-6 lg:max-w-none lg:grid-cols-4 overflow-hidden rounded-[8px] lg:rounded-none">
                                                <?php
                                                if (!empty($list['items']) && is_array($list['items'])):
                                                    $item_index = 0;
                                                    foreach ($list['items'] as $item):
                                                        $item_index++;

                                                        $cover_image = isset($item['cover_image']) ? $item['cover_image'] : false;
                                                        $cover_image_id = ($cover_image && !empty($cover_image['ID'])) ? $cover_image['ID'] : 0;
                                                        $cover_image_src = ($cover_image_id) ? wp_get_attachment_image_url($cover_image_id, 'large') : '';

                                                        $item_name = $item['item'] ?? '';
                                                        $item_price = $item['price'] ?? '';
                                                        $is_popular = !empty($item['is_popular']);
                                                        $description = $item['description'] ?? '';
                                                        $availability = !empty($item['availability']); // if true => "not available"
                                                        $dietary_pref = $item['dietary_preference'] ?? [];

                                                        // Only show items if availability is *not* checked
                                                        if (!$availability):
                                                            ?>
                                                            <div class="rounded-[8px]">
                                                                <!-- Item trigger -->
                                                                <a href="javascript:;"
                                                                    class="relative flex flex-col justify-between items-stretch hover:opacity-80"
                                                                    data-micromodal-trigger="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>">
                                                                    <?php if ($cover_image_src): ?>
                                                                        <div
                                                                            class="w-full aspect-[1/0.65] overflow-hidden shrink-0 rounded-[12px] relative">
                                                                            <img src="<?php echo esc_url($cover_image_src); ?>"
                                                                                alt="<?php echo esc_attr($cover_image['title'] ?? $item_name); ?>"
                                                                                class="object-cover object-center w-full h-full" />
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <div class="flex-1 flex flex-col pt-2">
                                                                        <?php if ($is_popular): ?>
                                                                            <div
                                                                                class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row mb-1">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red"
                                                                                    class="w-3.5">
                                                                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 
                                                                                         5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 
                                                                                         1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 
                                                                                         7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273
                                                                                         -4.117-3.527c-.887-.76-.415-2.212.749-2.305
                                                                                         l5.404-.434 2.082-5.005Z"
                                                                                        clip-rule="evenodd" />
                                                                                </svg>
                                                                                <span class="leading-5">Popular</span>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <div class="leading-7">
                                                                            <div class="text-gray-900 text-sm sm:text-base font-medium">
                                                                                <?php echo esc_html($item_name); ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="flex justify-between items-center">
                                                                            <div class="text-sm">
                                                                                <!-- If you have a currency partial -->
                                                                                <?php
                                                                                if ($country_symbol) {
                                                                                    get_template_part('page-templates/menu-parts/currency');
                                                                                }
                                                                                ?>
                                                                                <span class="font-normal">
                                                                                    <?php echo esc_html($item_price); ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <?php if (!empty($dietary_pref)): ?>
                                                                            <div class="flex mt-2 items-center gap-x-2">
                                                                                <?php
                                                                                foreach ($dietary_pref as $pref) {
                                                                                    // Example helper function returning an SVG or icon
                                                                                    $icon = get_dietary_icon($pref);
                                                                                    echo '<span>' . $icon . '</span>';
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </a>

                                                                <!-- Modal for this item -->
                                                                <div class="modal micromodal-slide relative z-[999999999] w-full"
                                                                    id="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>"
                                                                    aria-hidden="true">
                                                                    <div class="modal__overlay items-end sm:items-center" tabindex="-1"
                                                                        data-micromodal-close>
                                                                        <div class="modal__container relative z-999 transform overflow-hidden
                                                                            rounded-t-xl sm:rounded-lg bg-white shadow-xl transition-all
                                                                            w-full max-w-full sm:max-w-md h-[80vh] sm:h-auto"
                                                                            role="dialog" aria-modal="true" aria-labelledby="Item Modal">

                                                                            <!-- Close Button -->
                                                                            <button class="close-btn-i absolute w-[32px] h-[32px] left-[0.8rem] top-[0.8rem]
                                                                                rounded-full bg-white/70 text-gray-600 p-1 leading-4 text-4xl font-extralight
                                                                                hover:text-gray-900 hover:border-gray-900 focus-visible:outline
                                                                                focus-visible:outline-2 focus-visible:outline-offset-2
                                                                                focus-visible:outline-gray-600"
                                                                                data-micromodal-close>
                                                                            </button>

                                                                            <!-- Modal cover image -->
                                                                            <?php if ($cover_image_src): ?>
                                                                                <div class="w-full h-[300px] bg-no-repeat bg-center bg-cover"
                                                                                    style="background-image: url('<?php echo esc_url($cover_image_src); ?>');">
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <div class="p-4 h-full">
                                                                                <?php if ($is_popular): ?>
                                                                                    <div
                                                                                        class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row mb-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                                            fill="red" class="w-3.5">
                                                                                            <path fill-rule="evenodd"
                                                                                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 
                                                                                                   5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 
                                                                                                   1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 
                                                                                                   7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273
                                                                                                   -4.117-3.527c-.887-.76-.415-2.212.749-2.305
                                                                                                   l5.404-.434 2.082-5.005Z"
                                                                                                clip-rule="evenodd" />
                                                                                        </svg>
                                                                                        <span class="leading-5">Popular</span>
                                                                                    </div>
                                                                                <?php endif; ?>

                                                                                <div class="text-[1.2rem] font-medium">
                                                                                    <?php echo esc_html($item_name); ?>
                                                                                </div>

                                                                                <div class="text-sm text-gray-600 pt-1">
                                                                                    <?php echo esc_html($description); ?>
                                                                                </div>

                                                                                <div class="text-[1.2rem] mt-4">
                                                                                    <?php
                                                                                    if ($country_symbol) {
                                                                                        get_template_part('page-templates/menu-parts/currency');
                                                                                    }
                                                                                    ?>
                                                                                    <span class="font-normal">
                                                                                        <?php echo esc_html($item_price); ?>
                                                                                    </span>
                                                                                </div>

                                                                                <?php if (!empty($dietary_pref)): ?>
                                                                                    <div class="flex items-center mt-3 gap-x-3 text-[0.8rem]">
                                                                                        <?php
                                                                                        foreach ($dietary_pref as $pref) {
                                                                                            $icon = get_dietary_icon($pref);
                                                                                            echo '<span class="flex gap-x-1 leading-3 items-center">' . $icon . esc_html($pref) . '</span> ';
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                <?php endif; ?>

                                                                            </div><!-- .p-4 -->
                                                                        </div><!-- .modal__container -->
                                                                    </div><!-- .modal__overlay -->
                                                                </div><!-- .modal -->
                                                            </div><!-- .rounded-[8px] -->
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </dl>
                                        </div>
                                    </div>
                                    <?php
                                else:
                                    // =========================
                                    // Single-Column Layout
                                    // =========================
                                    ?>
                                    <div class="menu-container-inner pt-10 lg:pt-14 px-2" id="<?php echo esc_attr($menu_title); ?>">
                                        <div
                                            class="mx-auto max-w-2xl lg:text-center page-section ltr:pl-2 rtl:pr-2 lg:rtl:pr-0 lg:pl-0 sm:pb-8">
                                            <h2 class="text-3xl font-semibold sm:text-4xl">
                                                <?php echo esc_html($menu_title); ?>
                                            </h2>
                                            <?php if ($menu_content): ?>
                                                <p class="mt-6 text-lg leading-8 text-gray-600">
                                                    <?php echo wp_kses_post($menu_content); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mx-auto">
                                            <dl
                                                class="standard-menu grid max-full divide-y grid-cols-1 lg:gap-x-6 gap-y-4 lg:gap-y-5
                                                       lg:max-w-none lg:grid-cols-2 overflow-hidden rounded-[8px] lg:rounded-none">
                                                <?php
                                                if (!empty($list['items']) && is_array($list['items'])):
                                                    $item_index = 0;
                                                    foreach ($list['items'] as $item):
                                                        $item_index++;

                                                        $cover_image = $item['cover_image'] ?? false;
                                                        $cover_image_id = ($cover_image && !empty($cover_image['ID'])) ? $cover_image['ID'] : 0;
                                                        $cover_image_src = ($cover_image_id)
                                                            ? wp_get_attachment_image_url($cover_image_id, 'large')
                                                            : '';

                                                        $item_name = $item['item'] ?? '';
                                                        $item_price = $item['price'] ?? '';
                                                        $is_popular = !empty($item['is_popular']);
                                                        $description = $item['description'] ?? '';
                                                        $availability = !empty($item['availability']);
                                                        $dietary_pref = $item['dietary_preference'] ?? [];

                                                        if (!$availability): ?>
                                                            <div class="standard-menu-item bg-white">
                                                                <!-- Trigger: item name, image, price -->
                                                                <a href="javascript:;"
                                                                    class="relative flex flex-row justify-between items-stretch px-2 pt-5 lg:pt-6 hover:opacity-80"
                                                                    data-micromodal-trigger="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>">
                                                                    <div class="flex-1 flex flex-col justify-between">
                                                                        <div class="ltr:pr-4 rtl:pl-4 leading-7">
                                                                            <?php if ($is_popular): ?>
                                                                                <div
                                                                                    class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row mb-1">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red"
                                                                                        class="w-3.5">
                                                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 
                                                                                             5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 
                                                                                             1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 
                                                                                             7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273
                                                                                             -4.117-3.527c-.887-.76-.415-2.212.749-2.305
                                                                                             l5.404-.434 2.082-5.005Z"
                                                                                            clip-rule="evenodd" />
                                                                                    </svg>
                                                                                    <span class="leading-5">Popular</span>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <div class="text-gray-900 text-base lg:text-[1.1rem] font-medium">
                                                                                <?php echo esc_html($item_name); ?>
                                                                            </div>

                                                                            <?php
                                                                            // Truncate description if needed
                                                                            $max_length = 62;
                                                                            $display_desc = (strlen($description) > $max_length)
                                                                                ? substr($description, 0, $max_length) . '...'
                                                                                : $description;
                                                                            ?>
                                                                            <div class="text-xs text-gray-600 pt-1">
                                                                                <?php echo esc_html($display_desc); ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="flex justify-between ltr:pr-4 rtl:pl-4">
                                                                            <div class="text-base">
                                                                                <?php
                                                                                if ($country_symbol) {
                                                                                    get_template_part('page-templates/menu-parts/currency');
                                                                                }
                                                                                ?>
                                                                                <span class="font-medium">
                                                                                    <?php echo esc_html($item_price); ?>
                                                                                </span>
                                                                            </div>

                                                                            <?php if (!empty($dietary_pref)): ?>
                                                                                <div class="flex items-center gap-x-2">
                                                                                    <?php
                                                                                    foreach ($dietary_pref as $pref) {
                                                                                        $icon = get_dietary_icon($pref);
                                                                                        echo '<span>' . $icon . '</span>';
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>

                                                                    <?php if ($cover_image_src): ?>
                                                                        <div class="w-[105px] h-[105px] overflow-hidden shrink-0 rounded-[12px]">
                                                                            <img src="<?php echo esc_url($cover_image_src); ?>"
                                                                                alt="<?php echo esc_attr($cover_image['title'] ?? $item_name); ?>"
                                                                                class="object-cover object-center w-full h-full" />
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </a>

                                                                <!-- Modal -->
                                                                <div class="modal micromodal-slide relative z-[999999999] w-full"
                                                                    id="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>"
                                                                    aria-hidden="true">
                                                                    <div class="modal__overlay items-end sm:items-center" tabindex="-1"
                                                                        data-micromodal-close>
                                                                        <div class="modal__container relative z-999 transform overflow-hidden 
                                                                            rounded-t-xl sm:rounded-lg bg-white shadow-xl transition-all
                                                                            w-full max-w-full sm:max-w-md h-[80vh] sm:h-auto"
                                                                            role="dialog" aria-modal="true" aria-labelledby="Item Modal">

                                                                            <button
                                                                                class="close-btn-i absolute w-[32px] h-[32px] left-[0.8rem] top-[0.8rem]
                                                                                bg-white/70 rounded-full hover:text-gray-900 hover:border-gray-900
                                                                                focus-visible:outline focus-visible:outline-2 
                                                                                focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                                                                                data-micromodal-close>
                                                                            </button>

                                                                            <?php if ($cover_image_src): ?>
                                                                                <div class="w-full h-[300px] bg-no-repeat bg-center bg-cover"
                                                                                    style="background-image: url('<?php echo esc_url($cover_image_src); ?>');">
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <div class="p-4 h-full">
                                                                                <?php if ($is_popular): ?>
                                                                                    <div
                                                                                        class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row mb-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                                            fill="red" class="w-3.5">
                                                                                            <path fill-rule="evenodd"
                                                                                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 
                                                                                                 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 
                                                                                                 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 
                                                                                                 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273
                                                                                                 -4.117-3.527c-.887-.76-.415-2.212.749-2.305
                                                                                                 l5.404-.434 2.082-5.005Z"
                                                                                                clip-rule="evenodd" />
                                                                                        </svg>
                                                                                        <span class="leading-5">Popular</span>
                                                                                    </div>
                                                                                <?php endif; ?>

                                                                                <div class="text-[1.2rem] font-medium">
                                                                                    <?php echo esc_html($item_name); ?>
                                                                                </div>
                                                                                <div class="text-sm text-gray-600 pt-1">
                                                                                    <?php echo esc_html($description); ?>
                                                                                </div>
                                                                                <div class="text-[1.2rem] mt-4">
                                                                                    <?php
                                                                                    if ($country_symbol) {
                                                                                        get_template_part('page-templates/menu-parts/currency');
                                                                                    }
                                                                                    ?>
                                                                                    <span class="font-medium">
                                                                                        <?php echo esc_html($item_price); ?>
                                                                                    </span>
                                                                                </div>

                                                                                <?php if (!empty($dietary_pref)): ?>
                                                                                    <div class="flex items-center mt-3 gap-x-3 text-[0.8rem]">
                                                                                        <?php
                                                                                        foreach ($dietary_pref as $pref) {
                                                                                            $icon = get_dietary_icon($pref);
                                                                                            echo '<span class="flex gap-x-1 leading-3 items-center">' . $icon . esc_html($pref) . '</span> ';
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                <?php endif; ?>

                                                                            </div><!-- .p-4 -->
                                                                        </div><!-- .modal__container -->
                                                                    </div><!-- .modal__overlay -->
                                                                </div><!-- .modal -->
                                                            </div><!-- .standard-menu-item -->
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </dl>
                                        </div>
                                    </div>
                                    <?php
                                endif; // end if two_column
                            endforeach; // end foreach $restaurant_menu
                        endif; // end if $restaurant_menu
                    endforeach; // end foreach posts_array
                    wp_reset_postdata();
                endif;
                ?>
            </div><!-- .menu-container -->
        </main><!-- #main-content -->
    </div><!-- .menu-list -->
</div><!-- #restaurant-menu -->

<!-- Example CTA (commented out) -->
<!--
<a href="https://api.whatsapp.com/send?text=Hello,%20I’m%20interested%20in%20creating%20a%20digital%20menu%20for%20my%20business.&phone=+97337989445"
    class="animted-button-pulse-round">
    <span class="text-base md:text-lg">Get This Menu Now!</span>
    <span class="lets-chat">Let's Chat</span>
</a>
<div class="bottom-gradient"></div>
-->

<!-- ========== MODAL: Menu Categories ========== -->
<div class="modal micromodal-slide relative z-[9999999]" id="menu-cat" aria-hidden="true">
    <div class="modal__overlay items-end sm:items-center" tabindex="-1" data-micromodal-close>
        <div class="modal__container h-[60vh] relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 shadow-xl transition-all sm:my-8 w-full sm:max-w-md sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="Menu Categories">
            <header class="flex items-center pb-4">
                <button
                    class="text-gray-900 p-1 leading-4 text-4xl font-extralight hover:text-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                    data-micromodal-close>
                    &times;
                </button>
                <h3 class="text-base font-medium leading-6 text-gray-900 ml-4">Menu Categories</h3>
            </header>
            <main class="overflow-y-auto h-full">
                <ul role="list" class="list-none divide-y divide-gray-200 mb-8">
                    <?php
                    /**
                     * Reuse $posts_array to list categories or do a separate loop.
                     * Below shows how to link to anchors for each ‘restaurant_menu’ post in this category.
                     */
                    if (!empty($posts_array)):
                        foreach ($posts_array as $post_obj):
                            setup_postdata($post_obj);
                            $menu_title = get_the_title($post_obj);

                            // Count how many items are in each post’s 'restaurant_menu'
                            $restaurant_menu = get_field('restaurant_menu', $post_obj->ID);
                            $items_count = 0;
                            if ($restaurant_menu && is_array($restaurant_menu)) {
                                foreach ($restaurant_menu as $list) {
                                    if (!empty($list['items']) && is_array($list['items'])) {
                                        $items_count += count($list['items']);
                                    }
                                }
                            }
                            ?>
                            <li class="category-item py-4 pr-4">
                                <a href="#<?php echo esc_attr($menu_title); ?>" class="flex justify-between">
                                    <span><?php echo esc_html($menu_title); ?></span>
                                    <span><?php echo (int) $items_count; ?></span>
                                </a>
                            </li>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
            </main>
        </div><!-- .modal__container -->
    </div><!-- .modal__overlay -->
</div><!-- #menu-cat -->

<!-- Optional partials -->
<?php get_template_part('page-templates/menu-parts/info'); ?>
<?php get_template_part('page-templates/menu-parts/footer'); ?>
<?php get_template_part('page-templates/menu-parts/primary-color'); ?>

<?php get_footer(); ?>