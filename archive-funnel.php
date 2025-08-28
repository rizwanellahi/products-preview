<?php

/**
 * Template: archive-funnel.php
 * Purpose: Funnels directory with category index + anchored sections
 * Notes:
 * - Uses taxonomy "funnel_category"
 * - Tailwind CSS classes are applied to structure & style
 */

get_header();

// Fetch all funnel categories (only those that have posts; set hide_empty => false to show all)

$total_funnel_posts = 0;


$terms = get_terms([
  'taxonomy'   => 'funnel_category',
  'hide_empty' => true,
  'orderby'    => 'count', // sort by number of posts
  'order'      => 'DESC',  // most posts first
]);

foreach ($terms as $term) {
  $total_funnel_posts += $term->count;
}

?>
<main id="primary" class="min-h-screen bg-slate-50">
  <a id="top" class="sr-only">Top</a>

  <section class="relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
      <header class="mb-8 flex justify-between items-center">
        <div>
          <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900 flex items-center">Funnels
            <span class="ml-2 inline-flex items-center rounded-full bg-slate-900 px-4 py-1 text-xl font-medium text-slate-100">
              <?php echo $total_funnel_posts; ?>
            </span>
          </h1>
          <p class="mt-2 text-slate-600">Browse all funnels with categories.</p>
        </div>
        <a href="<?php echo esc_url(home_url('/')); ?>"
          class="inline-flex items-center rounded-xl border border-slate-200 px-4 sm:px-6 py-2 bg-slate-800 sm:py-4 text-sm font-medium text-slate-100 hover:bg-slate-700">
          Home
        </a>

      </header>

      <?php if (!is_wp_error($terms) && !empty($terms)) : ?>
        <!-- Layout: sticky category index (lg+) + content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

          <!-- Category Index -->
          <aside class="lg:col-span-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 lg:sticky lg:top-20">
              <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-500 mb-3">Categories</h2>

              <nav class="space-y-2" aria-label="Funnel category index">
                <?php foreach ($terms as $term) : ?>
                  <?php
                  $anchor_id = sanitize_title($term->slug);
                  ?>
                  <a href="#<?php echo esc_attr($anchor_id); ?>"
                    class="block rounded-xl border border-slate-200 px-3 py-2 text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition">
                    <span class="font-medium"><?php echo esc_html($term->name); ?></span>
                    <span class="ml-2 inline-flex items-center justify-center rounded-full bg-slate-200 px-2 text-xs text-slate-700 align-middle">
                      <?php echo intval($term->count); ?>
                    </span>
                  </a>
                <?php endforeach; ?>
              </nav>
            </div>
          </aside>

          <!-- Category Sections -->
          <div class="lg:col-span-9">
            <div class="space-y-16 scroll-smooth">
              <?php
              foreach ($terms as $term) :
                $anchor_id =  sanitize_title($term->slug);

                // Query all funnels in this term (consider limiting or paginating if you have a lot)
                $q = new WP_Query([
                  'post_type'           => 'funnel',
                  'posts_per_page'      => -1, // change to 12 if you want smaller sections + "View all" link
                  'ignore_sticky_posts' => true,
                  'no_found_rows'       => true,
                  'tax_query'           => [
                    [
                      'taxonomy' => 'funnel_category',
                      'field'    => 'term_id',
                      'terms'    => $term->term_id,
                    ]
                  ],
                  // perf: reduce term/meta cache churn if not needed
                  'update_post_term_cache' => false,
                ]);
                $term_link = get_term_link($term);
              ?>

                <section id="<?php echo esc_attr($anchor_id); ?>" class="scroll-mt-28">
                  <header class="mb-6">
                    <a href="<?php echo esc_url($term_link); ?>">
                      <div class="flex flex-row items-center gap-2">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900"><?php echo esc_html($term->name); ?></h2>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>
                      </div>
                    </a>
                    <?php
                    $desc = term_description($term->term_id, 'funnel_category');
                    if ($desc) :
                    ?>
                      <div class="prose prose-slate max-w-none mt-2 text-slate-600"><?php echo wp_kses_post($desc); ?></div>
                    <?php endif; ?>
                  </header>

                  <?php if ($q->have_posts()) : ?>
                    <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                      <?php while ($q->have_posts()) : $q->the_post(); ?>
                        <article class="group overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200 shadow-sm hover:shadow-md transition">
                          <a href="<?php the_permalink(); ?>" class="block">
                            <div class="aspect-[16/10] w-full overflow-hidden">
                              <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('small', [
                                  'class'   => 'h-full w-full object-cover transition group-hover:scale-[1.02]',
                                  'loading' => 'lazy',
                                  'alt'     => esc_attr(get_the_title()),
                                ]); ?>
                              <?php else : ?>
                                <div class="h-full w-full bg-gradient-to-br from-slate-100 to-slate-200"></div>
                              <?php endif; ?>
                            </div>
                          </a>

                          <div class="p-3 sm:p-5">
                            <h3 class="text-sm sm:text-lg font-semibold leading-tight text-slate-900">
                              <a href="<?php the_permalink(); ?>" class="hover:underline">
                                <?php the_title(); ?>
                              </a>
                            </h3>

                            <p class="mt-2 text-sm text-slate-600">
                              <?php
                              $excerpt = get_the_excerpt();
                              if (!$excerpt) {
                                $excerpt = wp_trim_words(wp_strip_all_tags(get_the_content('')), 26, '…');
                              }
                              echo esc_html($excerpt);
                              ?>
                            </p>

                            <?php
                            $post_terms = get_the_terms(get_the_ID(), 'funnel_category');
                            if ($post_terms && !is_wp_error($post_terms)) :
                            ?>
                              <div class="mt-4 flex flex-wrap gap-2">
                                <?php foreach ($post_terms as $pt) : ?>
                                  <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                    <?php echo esc_html($pt->name); ?>
                                  </span>
                                <?php endforeach; ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </article>
                      <?php endwhile; ?>
                    </div>
                  <?php else : ?>
                    <p class="text-slate-600">No posts found in this category.</p>
                  <?php endif;
                  wp_reset_postdata(); ?>

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
        <p class="text-slate-600">No funnel categories found.</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>