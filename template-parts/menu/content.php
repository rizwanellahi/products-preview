<?php

/**
 * template-parts/menu/content.php
 */

$args = wp_parse_args($args, [
    'posts_array' => [],
    'country_symbol' => '',
]);
$posts_array = $args['posts_array'];
$country_symbol = $args['country_symbol'];

// Just bail if nothing to show
if (empty($posts_array)) {
    return;
}

$theme_background_color = get_field('theme_background_color', 'option');
$card_background_color = get_field('card_background_color', 'option');

foreach ($posts_array as $post_obj):
    setup_postdata($post_obj);

    $menu_title = get_the_title($post_obj);
    $menu_section_description = get_field("section_description", $post_obj->ID);
    $menu_content = apply_filters('the_content', $post_obj->post_content);
    $restaurant_menu = get_field('restaurant_menu', $post_obj->ID);

    // Optional: promotion and deals flexible field
    if (have_rows('promotion_and_deals', $post_obj->ID)) {
        while (have_rows('promotion_and_deals', $post_obj->ID)) {
            the_row();
            $layout = get_row_layout();
            $output = '';
            if ($layout === 'picture') {
                $gallery = get_sub_field('image_gallery');
                if ($gallery && count($gallery) > 1):
                    ?>
                    <div class="glide promotion-container block w-full -mb-4 pt-6 lg:pt-8 px-2 lg:px-0">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides">
                                <?php
                                foreach ($gallery as $image):
                                    ?>
                                    <li class="glide__slide block rounded-2xl overflow-hidden relative">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="menu promo content"
                                            class="object-cover object-center max-h-[130px] lg:max-h-[200px] w-full entered litespeed-loaded">
                                        <?php if (!empty($image['title'])): ?>
                                            <div class="absolute bottom-0 left-0 flex justify-start items-end slider-bg-gradient">
                                                <div class="text-white text-lg sm:text-xl font-semibold pb-2 ltr:pl-3 rtl:pr-3 sm:p-4">
                                                    <?php echo esc_html($image['title']); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                    <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <!-- Dots Indicator -->
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            <?php
                            $counter = 0;
                            $gallery = get_sub_field('image_gallery');
                            if ($gallery):
                                foreach ($gallery as $image):
                                    ?>
                                    <button class="glide__bullet" data-glide-dir="=<?php echo $counter; ?>"></button>
                                    <?php
                                    $counter++;
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                <?php else:
                    foreach ($gallery as $image):
                        ?>
                        <div class="promotion-container block w-full -mb-4 pt-6 lg:pt-8 px-2 lg:px-0">
                            <div class="rounded-2xl overflow-hidden relative">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="Promot Media File"
                                    class="object-cover object-center max-h-[130px] lg:max-h-[200px] w-full entered litespeed-loaded">
                                <?php if (!empty($image['title'])): ?>
                                    <div class="absolute bottom-0 left-0 flex justify-start items-end slider-bg-gradient">
                                        <div class="text-white text-lg sm:text-xl font-semibold pb-2 ltr:pl-3 rtl:pr-3 sm:p-4">
                                            <?php echo esc_html($image['title']); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif;
            } elseif ($layout === 'video') {
                $video = get_sub_field('video');
                $thumbnail = get_sub_field('thumbnail');
                if ($video) {
                    $output .= '<div class="block rounded-2xl overflow-hidden">';
                    $output .= '<video muted autoplay loop playsinline poster="' . esc_url($thumbnail) . '" class="object-cover object-center max-h-[380px] lg:max-h-[400px] w-full">';
                    $output .= '<source src="' . esc_url($video) . '" type="video/mp4">';
                    $output .= 'Your browser does not support the video tag.';
                    $output .= '</video>';
                    $output .= '</div>';
                }
            }

            // Print output if not empty
            if (!empty($output)) {
                echo '<div class="promotion-container block w-full -mb-4 pt-0 px-2 lg:px-0">';
                echo $output;
                echo '</div>';
            }
        }
    }

    // Now display 'restaurant_menu' items
    if ($restaurant_menu && is_array($restaurant_menu)):
        foreach ($restaurant_menu as $list):
            // Check for two_column layout
            if (!empty($list['two_column'])):
                // TWO-COLUMN LAYOUT
                ?>
                <div class="featured-item-box pt-10 lg:pt-14" id="<?php echo esc_attr($menu_title); ?>">
                    <div
                        class="hidden mx-auto max-w-2xl lg:text-center page-section ltr:pl-4 rtl:pr-4 lg:rtl:pr-0 lg:pl-0 sm:pb-8 pb-3">
                        <h2 class="text-3xl font-semibold sm:text-4xl hidden">
                            <?php echo esc_html($menu_title); ?>
                        </h2>
                        <?php if ($menu_content): ?>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                <?php echo wp_kses_post($menu_content); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="mx-auto px-4 lg:px-6">
                        <div
                            class="grid max-full grid-cols-2 gap-8 lg:gap-8 lg:max-w-none lg:grid-cols-3 overflow-hidden rounded-[8px] lg:rounded-none items-stretch">
                            <?php if (!empty($list['items']) && is_array($list['items'])):
                                $item_index = 0;
                                foreach ($list['items'] as $item):
                                    $item_index++;
                                    $cover_image = $item['cover_image'] ?? false;
                                    $cover_image_id = ($cover_image && !empty($cover_image['ID'])) ? $cover_image['ID'] : 0;
                                    $cover_image_src = $cover_image_id ? wp_get_attachment_image_url($cover_image_id, 'large') : '';

                                    $item_name = $item['item'] ?? '';
                                    $item_price = $item['price'] ?? '';
                                    $is_popular = !empty($item['is_popular']);
                                    $description = $item['description'] ?? '';
                                    $availability = !empty($item['availability']); // If true => not available
                                    $dietary_pref = $item['dietary_preference'] ?? [];

                                    // Custom Badge
                                    $add_custom_badge = !empty($item['add_custom_badge']);
                                    $badge_name = $item['badge_name'] ?? '';
                                    $badge_background_color = $item['badge_background_color'] ?? '';

                                    $item_kcal = $item['item_kcal'] ?? '';

                                    $preparation_time = $item['preparation_time'] ?? '';
                                    $preparation_time_label = $item['preparation_time_label'] ?? '';

                                    $has_second_price = !empty($item['has_second_price']);
                                    $item_price_label = $item['first_price_label'] ?? '';
                                    $second_item_price = $item['second_price'] ?? '';
                                    $second_item_price_label = $item['second_price_label'] ?? '';

                                    if (!$availability): // Only show if item is available
                                        ?>
                                        <div class="flex flex-col">
                                            <!-- Trigger for modal -->
                                            <a href="javascript:;"
                                                class="relative h-full flex flex-col justify-between items-stretch hover:opacity-75 active:scale-95 transition transform duration-150 ease-out <?php echo $theme_background_color ? "bg-gray-50 rounded-xl" : "" ?>"
                                                style="background-color:<?php echo $card_background_color ?>"
                                                data-micromodal-trigger="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>">

                                                <div class="relative">
                                                    <?php if ($cover_image_src): ?>
                                                        <div class="w-full aspect-[1/0.65] overflow-hidden shrink-0 rounded-[12px] relative">
                                                            <img src="<?php echo esc_url($cover_image_src); ?>"
                                                                alt="<?php echo esc_attr($cover_image['title'] ?? $item_name); ?>"
                                                                class="object-cover object-center w-full h-full" />
                                                        </div>
                                                    <?php endif; ?>


                                                    <?php if (!empty($item_kcal) || !empty($dietary_pref)): ?>

                                                        <div
                                                            class="flex flex-row items-center justify-end gap-2 absolute px-2 py-1 right-0 bottom-[0px] rounded-tl-lg rounded-br-lg bg-gray-50">
                                                            <?php if (!empty($item_kcal)): ?>
                                                                <div class="flex flex-row items-center bg-gray-200 gap-1 ltr:pr-2 rtl:pl-2 rounded-full">
                                                                    <span class="bg-gray-300 rounded-full p-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            class="size-4" viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid">
                                                                            <defs>
                                                                                <style>
                                                                                    .cls-kcal-3 {
                                                                                        fill: url(#linear-gradient-1);
                                                                                    }

                                                                                    .cls-kcal-4 {
                                                                                        fill: #fc9502;
                                                                                    }

                                                                                    .cls-kcal-5 {
                                                                                        fill: #fce202;
                                                                                    }
                                                                                </style>

                                                                                <linearGradient id="linear-gradient-1" gradientUnits="userSpaceOnUse"
                                                                                    x1="94.141" y1="255" x2="94.141" y2="0.188">
                                                                                    <stop offset="0" stop-color="#ff4c0d" />
                                                                                    <stop offset="1" stop-color="#fc9502" />
                                                                                </linearGradient>
                                                                            </defs>
                                                                            <g id="fire">
                                                                                <path
                                                                                    d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z"
                                                                                    id="path-1" class="cls-kcal-3" fill-rule="evenodd" />
                                                                                <path
                                                                                    d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z"
                                                                                    id="path-2" class="cls-kcal-4" fill-rule="evenodd" />
                                                                                <path
                                                                                    d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z"
                                                                                    id="path-3" class="cls-kcal-5" fill-rule="evenodd" />
                                                                            </g>
                                                                        </svg>
                                                                    </span>
                                                                    <span class="text-xs"><?php echo $item_kcal ?> </span>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if (!empty($dietary_pref)): ?>
                                                                <div class="menu-item-allergens flex items-center gap-x-2">
                                                                    <?php foreach ($dietary_pref as $pref):
                                                                        $icon = get_dietary_icon($pref);
                                                                        echo '<span class="rounded-full p-1 border border-gray-900">' . $icon . '</span>';
                                                                    endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>


                                                <div class="flex-1 flex flex-col pt-3 <?php echo $theme_background_color ? "rounded-bl-xl rounded-br-xl bg-gray-50 px-2 sm:px-3 py-3" : "" ?>"
                                                    style="background-color:<?php echo $card_background_color ?>">
                                                    <div class="flex flex-row items-start gap-2">
                                                        <?php if ($is_popular): ?>
                                                            <div
                                                                class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row mb-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-3">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                <span class="leading-5">Popular</span>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ($add_custom_badge): ?>
                                                            <span
                                                                class="custom-badge inline-flex items-center rounded-full bg-gray-100 text-[0.7rem] font-medium mb-1"
                                                                style="background-color: <?php echo esc_attr($badge_background_color ? $badge_background_color : ""); ?>">
                                                                <?php echo esc_html($badge_name) ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="leading-7">
                                                        <div class="text-gray-900 text-base sm:text-lg font-semibold">
                                                            <?php echo esc_html($item_name); ?>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    // Truncate if needed
                                                    $max_length = 82;
                                                    $display_desc = (strlen($description) > $max_length)
                                                        ? substr($description, 0, $max_length) . '...'
                                                        : $description;
                                                    ?>
                                                    <div class="text-xs text-gray-600 pt-1">
                                                        <?php echo esc_html($display_desc); ?>
                                                    </div>

                                                    <?php if ($country_symbol) {
                                                        set_query_var('item', $item); // Pass the $item variable
                                                        set_query_var('list', $list);
                                                        get_template_part('page-templates/menu-parts/currency');
                                                    } ?>

                                                </div><!-- .flex-1 -->
                                            </a>

                                            <!-- Modal -->
                                            <?php
                                            set_query_var('item_name', $item_name);
                                            set_query_var('item_index', $item_index);
                                            set_query_var('menu_title', $menu_title);
                                            set_query_var('cover_image_src', $cover_image_src);
                                            set_query_var('description', $description);
                                            set_query_var('item_kcal', $item_kcal);
                                            set_query_var('preparation_time', $preparation_time);
                                            set_query_var('preparation_time_label', $preparation_time_label);
                                            set_query_var('is_popular', $is_popular);
                                            set_query_var('dietary_pref', $dietary_pref);
                                            set_query_var('country_symbol', $country_symbol);
                                            set_query_var('item', $item);
                                            set_query_var('list', $list); // needed for currency partial
                                            get_template_part('template-parts/menu/content-parts/modal-content');
                                            ?>
                                        </div>
                                        <?php
                                    endif; // end if availability
                                endforeach; // end foreach items
                            endif; ?>
                        </div>
                    </div>
                </div> <!-- .featured-item-box -->
                <?php
            else:
                // SINGLE COLUMN LAYOUT
                ?>
                <div class="menu-container-inner pt-10 lg:pt-14 px-2" id="<?php echo esc_attr($menu_title); ?>">
                    <div
                        class="hidden mx-auto max-w-2xl lg:text-center page-section ltr:pl-2 rtl:pr-2 lg:rtl:pr-0 lg:pl-0 pb-4 sm:pb-8">
                        <h2 class="text-3xl font-semibold sm:text-4xl">
                            <?php echo esc_html($menu_title); ?>
                        </h2>
                        <?php if ($menu_content): ?>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                <?php echo wp_kses_post($menu_content); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($menu_section_description): ?>
                            <p class="mt-2 text-base sm:text-lg leading-8 text-gray-600">
                                <?php echo esc_html($menu_section_description); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="mx-auto">
                        <div class="standard-menu grid max-full <?php echo $theme_background_color ? "divide-y-0" : "" ?> divide-y grid-cols-1 lg:gap-x-6 gap-y-2 sm:gap-y-4 lg:gap-y-2
                                   lg:max-w-none lg:grid-cols-2 overflow-hidden">
                            <?php if (!empty($list['items']) && is_array($list['items'])):
                                $item_index = 0;
                                foreach ($list['items'] as $item):
                                    $item_index++;

                                    $cover_image = $item['cover_image'] ?? false;
                                    $cover_image_id = ($cover_image && !empty($cover_image['ID'])) ? $cover_image['ID'] : 0;
                                    $cover_image_src = $cover_image_id ? wp_get_attachment_image_url($cover_image_id, 'large') : '';

                                    $item_name = $item['item'] ?? '';
                                    $item_price = $item['price'] ?? '';
                                    $is_popular = !empty($item['is_popular']);
                                    $description = $item['description'] ?? '';
                                    $availability = !empty($item['availability']);
                                    $dietary_pref = $item['dietary_preference'] ?? [];

                                    // Custom Badge
                                    $add_custom_badge = !empty($item['add_custom_badge']);
                                    $badge_name = $item['badge_name'] ?? '';
                                    $badge_background_color = $item['badge_background_color'] ?? '';

                                    $item_kcal = $item['item_kcal'] ?? '';

                                    $preparation_time = $item['preparation_time'] ?? '';
                                    $preparation_time_label = $item['preparation_time_label'] ?? '';

                                    $has_second_price = !empty($item['has_second_price']);
                                    $item_price_label = $item['first_price_label'] ?? '';
                                    $second_item_price = $item['second_price'] ?? '';
                                    $second_item_price_label = $item['second_price_label'] ?? '';

                                    if (!$availability):
                                        ?>
                                        <div class="standard-menu-item <?php echo $theme_background_color ? "rounded-xl bg-gray-50" : "" ?>"
                                            style="background-color:<?php echo $card_background_color ?>">
                                            <a href="javascript:;"
                                                class="relative flex h-full flex-row justify-between items-center px-4 pt-4 pb-4 hover:opacity-80"
                                                data-micromodal-trigger="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>">
                                                <div class="flex flex-1 flex-col justify-around h-full gap-y-2">
                                                    <div class="ltr:pr-4 rtl:pl-4 leading-7">
                                                        <div class="flex flex-row items-start gap-2">
                                                            <?php if ($is_popular): ?>
                                                                <div
                                                                    class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row mb-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-3">
                                                                        <path fill-rule="evenodd"
                                                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    <span class="leading-5">Popular</span>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($add_custom_badge): ?>
                                                                <span
                                                                    class="custom-badge inline-flex items-center rounded-full bg-gray-100 text-[0.7rem] font-medium mb-1"
                                                                    style="background-color: <?php echo esc_attr($badge_background_color ? $badge_background_color : ""); ?>">
                                                                    <?php echo esc_html($badge_name) ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="text-gray-900 text-lg sm:text-xl font-semibold">
                                                            <?php echo esc_html($item_name); ?>
                                                        </div>

                                                        <?php
                                                        // Truncate if needed
                                                        $max_length = 62;
                                                        $display_desc = (strlen($description) > $max_length)
                                                            ? substr($description, 0, $max_length) . '...'
                                                            : $description;
                                                        ?>
                                                        <div class="text-xs text-gray-600 pt-1">
                                                            <?php echo esc_html($display_desc); ?>
                                                        </div>
                                                    </div>

                                                    <div class="flex justify-between items-center ltr:pr-4 rtl:pl-4">
                                                        <?php if ($country_symbol) {
                                                            set_query_var('item', $item); // Pass the $item variable
                                                            set_query_var('list', $list);
                                                            get_template_part('page-templates/menu-parts/currency');
                                                        } ?>

                                                        <div class="flex flex-row items-center gap-2">
                                                            <?php if (!empty($item_kcal)): ?>
                                                                <div
                                                                    class="flex flex-row items-center bg-gray-100 gap-1 ltr:pr-2 rtl:pl-2 rounded-full">
                                                                    <span class="bg-gray-200 rounded-full p-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink" class="size-4"
                                                                            viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid">
                                                                            <defs>
                                                                                <style>
                                                                                    .cls-kcal-3 {
                                                                                        fill: url(#linear-gradient-1);
                                                                                    }

                                                                                    .cls-kcal-4 {
                                                                                        fill: #fc9502;
                                                                                    }

                                                                                    .cls-kcal-5 {
                                                                                        fill: #fce202;
                                                                                    }
                                                                                </style>

                                                                                <linearGradient id="linear-gradient-1" gradientUnits="userSpaceOnUse"
                                                                                    x1="94.141" y1="255" x2="94.141" y2="0.188">
                                                                                    <stop offset="0" stop-color="#ff4c0d" />
                                                                                    <stop offset="1" stop-color="#fc9502" />
                                                                                </linearGradient>
                                                                            </defs>
                                                                            <g id="fire">
                                                                                <path
                                                                                    d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z"
                                                                                    id="path-1" class="cls-kcal-3" fill-rule="evenodd" />
                                                                                <path
                                                                                    d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z"
                                                                                    id="path-2" class="cls-kcal-4" fill-rule="evenodd" />
                                                                                <path
                                                                                    d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z"
                                                                                    id="path-3" class="cls-kcal-5" fill-rule="evenodd" />
                                                                            </g>
                                                                        </svg>
                                                                    </span>
                                                                    <span class="text-xs"><?php echo $item_kcal ?> </span>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if (!empty($dietary_pref)): ?>
                                                                <div class="flex items-center gap-x-2">
                                                                    <?php foreach ($dietary_pref as $pref):
                                                                        $icon = get_dietary_icon($pref);
                                                                        echo '<span>' . $icon . '</span>';
                                                                    endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
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
                                            <?php
                                            set_query_var('item_name', $item_name);
                                            set_query_var('item_index', $item_index);
                                            set_query_var('menu_title', $menu_title);
                                            set_query_var('cover_image_src', $cover_image_src);
                                            set_query_var('description', $description);
                                            set_query_var('item_kcal', $item_kcal);
                                            set_query_var('preparation_time', $preparation_time);
                                            set_query_var('preparation_time_label', $preparation_time_label);
                                            set_query_var('is_popular', $is_popular);
                                            set_query_var('dietary_pref', $dietary_pref);
                                            set_query_var('country_symbol', $country_symbol);
                                            set_query_var('item', $item);
                                            set_query_var('list', $list); // needed for currency partial
                                            get_template_part('template-parts/menu/content-parts/modal-content');
                                            ?>
                                        </div>
                                        <?php
                                    endif; // end if !$availability
                                endforeach; // end foreach
                            endif; ?>
                        </div>
                    </div>
                </div> <!-- .menu-container-inner -->
                <?php
            endif; // end if two_column
        endforeach; // end foreach $restaurant_menu
    endif; // end if $restaurant_menu
endforeach; // end foreach $posts_array

wp_reset_postdata();

?>