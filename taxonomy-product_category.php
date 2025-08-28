<?php
/* taxonomy-product_category.php */
get_header();
$term = get_queried_object();
?>

<main id="primary" class="min-h-screen bg-slate-50">
  <section class="relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
      <!-- Breadcrumbs -->
      <nav class="text-sm text-slate-600 mb-4 flex justify-between items-center">
        <div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:underline">Home</a>
        <span class="mx-2">/</span>
        <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="hover:underline">Products</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900 font-medium"><?php single_term_title(); ?></span>
        </div>

        <a href="<?php echo esc_url(home_url('/')); ?>"
          class="inline-flex items-center rounded-xl border border-slate-200 px-4 sm:px-6 py-2 bg-slate-800 sm:py-4 text-sm font-medium text-slate-100 hover:bg-slate-700">
          Home
        </a>
        


      </nav>

      <!-- Header -->
      <header class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900 flex items-center">
          <?php echo esc_html(single_term_title('', false)); ?>

          <span class="ml-4 inline-flex items-center rounded-full bg-slate-900 px-4 py-1 text-xl font-medium text-slate-100">
              <?php echo esc_html( $term->count ); ?>
            </span>

        </h1>
        <?php if (term_description()) : ?>
          <div class="prose prose-slate max-w-none mt-3 text-slate-700">
            <?php echo wp_kses_post(term_description()); ?>
          </div>
        <?php endif; ?>
      </header>

      <?php if (have_posts()) : ?>
        <div class="overflow-x-auto rounded-2xl ring-1 ring-slate-200 bg-white shadow-sm">
          <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
              <tr>
                <th class="text-xs sm:text-base px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Product</th>
                <th class="text-xs sm:text-base px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Shop Domain</th>
                <th class="text-xs sm:text-base px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">AdvtID</th>
                <th class="text-xs sm:text-base px-3 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Category</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <?php while (have_posts()) : the_post();
                $shop_domain    = function_exists('get_field') ? get_field('shop_domain')    : get_post_meta(get_the_ID(), 'shop_domain', true);
                $landers_domain = function_exists('get_field') ? get_field('landers_domain') : get_post_meta(get_the_ID(), 'landers_domain', true);
                $advt_id        = function_exists('get_field') ? get_field('advt_id')        : get_post_meta(get_the_ID(), 'advt_id', true);

                $excerpt = get_the_excerpt();
                if (!$excerpt) {
                  $excerpt = wp_trim_words(wp_strip_all_tags(get_the_content('')), 24, '…');
                }
                $row_terms = get_the_terms(get_the_ID(), 'product_category');

                $format_domain = function($val) {
                  if (empty($val)) return '—';
                  $url = (stripos($val, 'http://') === 0 || stripos($val, 'https://') === 0)
                    ? $val
                    : 'https://' . ltrim($val, '/');
                  return '<a class="text-xs sm:text-base text-slate-900 hover:underline break-all" href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer">' . esc_html($val) . '</a>';
                };
                $shop_display    = $format_domain($shop_domain);
                $landers_display = $format_domain($landers_domain);
              ?>
                <tr class="hover:bg-slate-50">
                  <td class="px-4 py-3 align-top">
                    <div class="flex items-center gap-3">
                      <a href="<?php the_permalink(); ?>" class="block size-12 overflow-hidden rounded-lg ring-1 ring-slate-200 bg-slate-100">
                        <?php if (has_post_thumbnail()) {
                          the_post_thumbnail('thumbnail', ['class'=>'h-full w-full object-cover','loading'=>'lazy','alt'=>esc_attr(get_the_title())]);
                        } ?>
                      </a>
                      <div>
                        <a href="<?php the_permalink(); ?>" class="text-xs sm:text-base font-medium text-slate-900 hover:underline"><?php the_title(); ?></a>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 align-top text-sm"><?php echo $shop_display; // intentionally not escaped ?></td>
                  <td class="px-4 py-3 align-top text-sm text-slate-900 font-semibold"><?php echo $advt_id !== '' ? esc_html($advt_id) : '—'; ?></td>
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
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <nav class="mt-10">
          <?php
          the_posts_pagination([
            'mid_size'  => 1,
            'prev_text' => '<span class="inline-flex items-center rounded-xl border border-slate-200 px-3 py-1.5 text-sm hover:bg-slate-50">Previous</span>',
            'next_text' => '<span class="inline-flex items-center rounded-xl border border-slate-200 px-3 py-1.5 text-sm hover:bg-slate-50">Next</span>',
            'screen_reader_text' => 'Products navigation',
          ]);
          ?>
        </nav>
      <?php else : ?>
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
          <p class="text-slate-600">No products found in this category.</p>
          <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"
             class="mt-4 inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
            Back to all products
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>