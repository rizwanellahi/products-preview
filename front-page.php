<?php

/**
 * front-page.php
 * Make the home page render the Projects archive UI.
 */

// Optionally set a flag if you want slightly different copy on home
// set_query_var('is_funnel_front', true);

// If you already have archive-project.php with all the markup, just load it:
// get_template_part('archive', 'funnel'); // looks for archive-project.php

// Or, if you want to be 100% certain it loads that file:
// $tpl = locate_template('archive-funnel.php', true);


/**
 * front-page.php
 * Home page with tabs to switch between Funnels and Products previews.
 */

get_header();
?>
<main id="primary" class="min-h-screen bg-slate-50">
  <!-- Hero -->
  <section class="relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
      <header class="mb-6">
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">Explore</h1>
        <p class="mt-2 text-slate-600">Browse Funnels and Products in one place.</p>
      </header>

      <!-- Tabs -->
      <div class="border-b border-slate-200">
        <nav class="-mb-px flex gap-6" aria-label="Sections" id="home-tabs">
          <a href="#funnels" data-target="tab-funnels"
            class="tab-link border-b-2 border-transparent text-slate-600 hover:text-slate-900 px-1 pb-3 text-sm font-medium">
            Funnels
          </a>
          <a href="#products" data-target="tab-products"
            class="tab-link border-b-2 border-transparent text-slate-600 hover:text-slate-900 px-1 pb-3 text-sm font-medium">
            Products
          </a>
        </nav>
      </div>
    </div>
  </section>

  <!-- Tab: Funnels -->

   <?php
      // Pull 6 latest funnels
      $funnels = new WP_Query([
        'post_type'           => 'funnel',
        'posts_per_page'      => -1,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
      ]);
      $total_funnels = $funnels->post_count;
      ?>


  <section id="tab-funnels" class="tab-panel relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-4 flex items-center justify-between gap-4">
        <a href="<?php echo esc_url(get_post_type_archive_link('funnel')); ?>">
          <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 flex justify-center items-center">Funnels
            <span class="ml-2 inline-flex items-center rounded-full bg-slate-200 px-2.5 py-1 text-sm font-medium text-slate-700">
              <?php echo $total_funnels; ?>
            </span>

          </h2>
        </a>
        <a href="<?php echo esc_url(get_post_type_archive_link('funnel')); ?>"
          class="inline-flex items-center rounded-xl border border-slate-200 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
          View all
        </a>
      </div>

      <?php if ($funnels->have_posts()) : ?>
        <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-4 gap-6">
          <?php while ($funnels->have_posts()) : $funnels->the_post(); ?>
            <article class="group overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200 shadow-sm hover:shadow-md transition">
              <a href="<?php the_permalink(); ?>" class="block">
                <div class="aspect-[16/10] w-full overflow-hidden">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', [
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
                  <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                </h3>
                <p class="mt-2 text-sm text-slate-600">
                  <?php
                  $ex = get_the_excerpt();
                  if (!$ex) {
                    $ex = wp_trim_words(wp_strip_all_tags(get_the_content('')), 22, '…');
                  }
                  echo esc_html($ex);
                  ?>
                </p>
                <?php
                $chips = get_the_terms(get_the_ID(), 'funnel_category');
                if ($chips && !is_wp_error($chips)) : ?>
                  <div class="mt-4 flex flex-wrap gap-2">
                    <?php foreach ($chips as $c) : ?>
                      <a href="<?php echo esc_url(get_term_link($c)); ?>"
                        class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 hover:bg-slate-200">
                        <?php echo esc_html($c->name); ?>
                      </a>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </article>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
      <?php else : ?>
        <p class="text-slate-600">No funnels yet.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Tab: Products -->

  <?php
  // Pull 6 latest products
  $products = new WP_Query([
    'post_type'           => 'product',
    'posts_per_page'      => -1,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
  ]);

  $total_posts = $products->post_count;

  ?>


  <section id="tab-products" class="tab-panel relative hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-6 flex items-center justify-between gap-4">
        <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">
          <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 flex justify-center items-center">
            Products
            <span class="ml-2 inline-flex items-center rounded-full bg-slate-200 px-2.5 py-1 text-sm font-medium text-slate-700">
              <?php echo $total_posts; ?>
            </span>
          </h2>
        </a>
        <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"
          class="inline-flex items-center rounded-xl border border-slate-200 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
          View all
        </a>
      </div>

      <?php if ($products->have_posts()) : ?>
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
              <?php while ($products->have_posts()) : $products->the_post();
                // ACF/meta
                $shop_domain    = function_exists('get_field') ? get_field('shop_domain')    : get_post_meta(get_the_ID(), 'shop_domain', true);
                $landers_domain = function_exists('get_field') ? get_field('landers_domain') : get_post_meta(get_the_ID(), 'landers_domain', true);
                $advt_id        = function_exists('get_field') ? get_field('advt_id')        : get_post_meta(get_the_ID(), 'advt_id', true);

                $format_domain = function ($val) {
                  if (empty($val)) return '—';
                  $url = (stripos($val, 'http://') === 0 || stripos($val, 'https://') === 0)
                    ? $val
                    : 'https://' . ltrim($val, '/');
                  return '<a class="text-xs sm:text-base text-slate-900 hover:underline break-all" href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer">' . esc_html($val) . '</a>';
                };
                $shop_display    = $format_domain($shop_domain);
                $landers_display = $format_domain($landers_domain);

                // Categories for badges
                $row_terms = get_the_terms(get_the_ID(), 'product_category');
              ?>
                <tr class="hover:bg-slate-50">
                  <td class="px-4 py-3 align-top">
                    <div class="flex items-center gap-3">
                      <a href="<?php the_permalink(); ?>" class="block size-10 overflow-hidden rounded-lg ring-1 ring-slate-200 bg-slate-100">
                        <?php if (has_post_thumbnail()) {
                          the_post_thumbnail('thumbnail', ['class' => 'h-full w-full object-cover', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title())]);
                        } ?>
                      </a>
                      <div>
                        <a href="<?php the_permalink(); ?>" class="text-xs sm:text-base font-medium text-slate-900 hover:underline"><?php the_title(); ?></a>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 align-top text-sm"><?php echo $shop_display; // safe html 
                                                          ?></td>
                  </td>
                  <td class="px-4 py-3 align-top text-sm text-slate-900 font-semibold"><?php echo $advt_id !== '' ? esc_html($advt_id) : '—'; ?></td>
                  <td class="px-4 py-3 align-top">
                    <?php if ($row_terms && !is_wp_error($row_terms)) : ?>
                      <div class="flex flex-wrap gap-1.5">
                        <?php foreach ($row_terms as $t) : ?>
                          <a href="<?php echo esc_url(get_term_link($t)); ?>"
                            class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 hover:bg-slate-200">
                            <?php echo esc_html($t->name); ?>
                          </a>
                        <?php endforeach; ?>
                      </div>
                    <?php else : ?>
                      —
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endwhile;
              wp_reset_postdata(); ?>
            </tbody>
          </table>
        </div>
      <?php else : ?>
        <p class="text-slate-600">No products yet.</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php
// Minimal, dependency-free tabs
// - Applies active styles
// - Switches content panes
?>
<script>
  (function() {
    const tabLinks = document.querySelectorAll('#home-tabs .tab-link');
    const panels = {
      'tab-funnels': document.getElementById('tab-funnels'),
      'tab-products': document.getElementById('tab-products')
    };

    function setActive(targetId) {
      Object.keys(panels).forEach(id => {
        if (!panels[id]) return;
        panels[id].classList.toggle('hidden', id !== targetId);
      });
      tabLinks.forEach(a => {
        const isActive = a.getAttribute('data-target') === targetId;
        a.classList.toggle('border-slate-900', isActive);
        a.classList.toggle('text-slate-900', isActive);
        a.classList.toggle('border-transparent', !isActive);
        a.classList.toggle('text-slate-600', !isActive);
      });
    }

    function initFromHash() {
      const hash = (location.hash || '').replace('#', '');
      const target = (hash === 'products') ? 'tab-products' : 'tab-funnels';
      setActive(target);
    }

    tabLinks.forEach(a => {
      a.addEventListener('click', (e) => {
        const targetId = a.getAttribute('data-target');
        setActive(targetId);
      });
    });

    window.addEventListener('hashchange', initFromHash);
    initFromHash();
  })();
</script>

<?php get_footer(); ?>