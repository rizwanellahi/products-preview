<?php

/**
 * Template: archive-product.php
 * Purpose: Products directory with left category index + category sections rendered as tables
 * Notes:
 * - Uses taxonomy "product_category"
 * - Optional custom fields supported: _price, _sku
 */

get_header();

// Grab all product categories with posts
$terms = get_terms([
    'taxonomy'   => 'product_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

?>
<main id="primary" class="min-h-screen bg-slate-50">
    <a id="top" class="sr-only">Top</a>

    <section class="relative">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
            <header class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">Products</h1>
                <p class="mt-2 text-slate-600">Browse all products by category.</p>
            </header>

            <?php if (!is_wp_error($terms) && !empty($terms)) : ?>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Category Index -->
                    <aside class="lg:col-span-3">
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 lg:sticky lg:top-20">
                            <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-500 mb-3">Categories</h2>
                            <nav class="space-y-2" aria-label="Product category index">
                                <?php foreach ($terms as $term) :
                                    $anchor_id = sanitize_title($term->slug); ?>
                                    <a href="#<?php echo esc_attr($anchor_id); ?>"
                                        class="block rounded-xl border border-slate-200 px-3 py-2 text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition">
                                        <span class="font-medium"><?php echo esc_html($term->name); ?></span>
                                        <span class="ml-2 inline-flex items-center justify-center rounded-full bg-slate-100 px-2 text-xs text-slate-600 align-middle">
                                            <?php echo intval($term->count); ?>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </nav>
                        </div>
                    </aside>

                    <!-- Category Tables -->
                    <div class="lg:col-span-9">
                        <div class="space-y-16 scroll-smooth">
                            <?php foreach ($terms as $term) :
                                $anchor_id = sanitize_title($term->slug);
                                $term_link = get_term_link($term);

                                // Fetch all products for this category
                                $q = new WP_Query([
                                    'post_type'      => 'product',
                                    'posts_per_page' => -1,
                                    'no_found_rows'  => true,
                                    'tax_query'      => [[
                                        'taxonomy' => 'product_category',
                                        'field'    => 'term_id',
                                        'terms'    => $term->term_id,
                                    ]],
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                    'update_post_term_cache' => false,
                                ]);
                            ?>
                                <section id="<?php echo esc_attr($anchor_id); ?>" class="scroll-mt-28">
                                    <header class="mb-4 flex items-center justify-between">
                                        <a href="<?php echo esc_url($term_link); ?>" class="group">
                                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 inline-flex items-center gap-2">
                                                <?php echo esc_html($term->name); ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-5 stroke-1.5" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.69a4.5 4.5 0 011.24 7.24l-4.5 4.5a4.5 4.5 0 01-6.36-6.36l1.76-1.76m13.35-.62 1.76-1.76a4.5 4.5 0 00-6.36-6.36l-4.5 4.5a4.5 4.5 0 001.24 7.24" />
                                                </svg>
                                            </h2>
                                        </a>
                                        <?php if ($term->description): ?>
                                            <div class="text-sm text-slate-600 max-w-prose"><?php echo wp_kses_post($term->description); ?></div>
                                        <?php endif; ?>
                                    </header>

                                    <?php if ($q->have_posts()) : ?>
                                        <div class="overflow-x-auto rounded-2xl ring-1 ring-slate-200 bg-white shadow-sm">
                                            <table class="min-w-full divide-y divide-slate-200">
                                                <thead class="bg-slate-50">
                                                    <tr>
                                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Product</th>
                                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Description</th>
                                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Shop Domain</th>
                                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">AdvtID</th>
                                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Categories</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-slate-100">
                                                    <?php while ($q->have_posts()) : $q->the_post();
                                                        $price = get_post_meta(get_the_ID(), '_price', true);
                                                        $sku   = get_post_meta(get_the_ID(), '_sku', true);
                                                        $excerpt = get_the_excerpt();
                                                        if (!$excerpt) {
                                                            $excerpt = wp_trim_words(wp_strip_all_tags(get_the_content('')), 24, '…');
                                                        }
                                                        $row_terms = get_the_terms(get_the_ID(), 'product_category');
                                                    ?>
                                                        <tr class="hover:bg-slate-50">
                                                            <td class="px-4 py-3 align-top">
                                                                <div class="flex items-center gap-3">
                                                                    <a href="<?php the_permalink(); ?>" class="block size-12 overflow-hidden rounded-lg ring-1 ring-slate-200 bg-slate-100">
                                                                        <?php if (has_post_thumbnail()) {
                                                                            the_post_thumbnail('thumbnail', ['class' => 'h-full w-full object-cover', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title())]);
                                                                        } ?>
                                                                    </a>
                                                                    <div>
                                                                        <a href="<?php the_permalink(); ?>" class="font-medium text-slate-900 hover:underline"><?php the_title(); ?></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-3 align-top text-sm text-slate-700"><?php echo esc_html($excerpt); ?></td>
                                                            <td class="px-4 py-3 align-top text-sm text-slate-700"><?php echo $sku ? esc_html($sku) : '—'; ?></td>
                                                            <td class="px-4 py-3 align-top text-sm text-slate-900 font-semibold">
                                                                <?php echo $price !== '' ? esc_html($price) : '—'; ?>
                                                            </td>
                                                            <td class="px-4 py-3 align-top">
                                                                <?php if ($row_terms && !is_wp_error($row_terms)) : ?>
                                                                    <div class="flex flex-wrap gap-1.5">
                                                                        <?php foreach ($row_terms as $t) : ?>
                                                                            <a href="<?php echo esc_url(get_term_link($t)); ?>" class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 hover:bg-slate-200">
                                                                                <?php echo esc_html($t->name); ?>
                                                                            </a>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile;
                                                    wp_reset_postdata(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-slate-600">No products in this category.</p>
                                    <?php endif; ?>

                                    <div class="mt-6">
                                        <a href="#top" class="inline-flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-slate-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 5l7 7-1.41 1.41L13 9.83V20h-2V9.83l-4.59 4.58L5 12z" />
                                            </svg>
                                            Back to top
                                        </a>
                                    </div>
                                </section>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <p class="text-slate-600">No product categories found.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>