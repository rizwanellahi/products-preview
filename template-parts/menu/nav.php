<?php
/**
 * template-parts/menu/nav.php
 * 
 * Creates the anchor link navigation for each restaurant_menu post.
 */

// Safely extract incoming data
$args = wp_parse_args($args, ['posts_array' => []]);
$posts_array = $args['posts_array'];

$card_background_color = get_field('card_background_color', 'option');

?>

<!-- ========== NAV SECTIONS ========== -->
<nav class="nav-sections mx-auto max-w-2xl lg:max-w-4xl rounded-lg" style="background-color:<?php echo $card_background_color ?>">
    <a href="javascript:;" data-micromodal-trigger="menu-cat" class="block" aria-label="Open item categories">
        <div class="absolute top-0 rtl:right-0 ltr:left-0 h-[99%] flex items-center z-[99] px-2">
            <!-- Burger Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>
    </a>

    <ul class="menu ltr:ml-[2.5rem] rtl:mr-[2.5rem] mx-auto max-w-2xl lg:max-w-4xl">
        <?php if (!empty($posts_array)): ?>
            <?php foreach ($posts_array as $post_obj): ?>
                <?php
                // best practice: no need to call setup_postdata() if we only want the title
                $menu_title = get_the_title($post_obj);
                ?>
                <li class="menu-item">
                    <a class="menu-item-link text-gray-600 font-medium text-base" href="#<?php echo esc_attr($menu_title); ?>">
                        <?php echo esc_html($menu_title); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="active-line"></div>
    </ul>
</nav>
<!-- ========== /NAV SECTIONS ========== -->