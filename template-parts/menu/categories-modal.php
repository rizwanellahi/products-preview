<?php
/**
 * template-parts/menu/categories-modal.php
 */

$args = wp_parse_args($args, [
    'posts_array' => [],
]);
$posts_array = $args['posts_array'];
?>
<div class="modal micromodal-slide relative z-[9999999]" id="menu-cat" aria-hidden="true">
    <div class="modal__overlay items-end sm:items-center" tabindex="-1" data-micromodal-close>
        <div class="modal__container h-[60vh] relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4
            shadow-xl transition-all sm:my-8 w-full sm:max-w-md sm:p-6" role="dialog" aria-modal="true"
            aria-labelledby="Menu Categories">
            <header class="flex items-center pb-4">
                <button class="text-gray-900 p-1 leading-4 text-4xl font-extralight hover:text-gray-500 
                           focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                           focus-visible:outline-gray-600" data-micromodal-close>
                    &times;
                </button>
                <h3 class="text-base font-medium leading-6 text-gray-900 ml-4">Menu Categories</h3>
            </header>
            <main class="overflow-y-auto h-full">
                <ul role="list" class="list-none divide-y divide-gray-200 mb-8">
                    <?php if (!empty($posts_array)): ?>
                        <?php foreach ($posts_array as $post_obj):
                            $menu_title = get_the_title($post_obj);
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
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </main>
        </div><!-- .modal__container -->
    </div><!-- .modal__overlay -->
</div><!-- #menu-cat -->