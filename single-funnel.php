<?php

/**
 * Single Template for Funnel
 * File: single-funnel.php
 */

get_header();
the_post();

// Grab terms for chips & related
$terms        = get_the_terms(get_the_ID(), 'funnel_category');
$primary_term = $terms && !is_wp_error($terms) ? array_shift($terms) : null;
$all_terms    = get_the_terms(get_the_ID(), 'funnel_category');
?>

<main id="primary" class="min-h-screen bg-slate-50">
  <!-- Hero -->
  <section class="relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-10">
      <nav class="text-sm text-slate-600 mb-4 flex justify-between items-center">
        <div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:underline">Home</a>
        <span class="mx-2">/</span>
        <a href="<?php echo esc_url(get_post_type_archive_link('funnel')); ?>" class="hover:underline">Funnels</a>
        <?php if ($primary_term): ?>
          <span class="mx-2">/</span>
          <a class="hover:underline" href="<?php echo esc_url(get_term_link($primary_term)); ?>">
            <?php echo esc_html($primary_term->name); ?>
          </a>
        <?php endif; ?>
        </div>

        <a href="<?php echo esc_url(home_url('/')); ?>"
          class="inline-flex items-center rounded-xl border border-slate-200 px-4 sm:px-6 py-2 bg-slate-800 sm:py-4 text-sm font-medium text-slate-100 hover:bg-slate-700">
          Home
        </a>

      </nav>

      <header class="mb-6">
        <div>
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
          <?php echo esc_html(get_the_title()); ?>
        </h1>

        <?php if ($all_terms && !is_wp_error($all_terms)) : ?>
          <div class="mt-4 flex flex-wrap gap-2">
            <?php foreach ($all_terms as $t): ?>
              <a href="<?php echo esc_url(get_term_link($t)); ?>"
                class="inline-flex items-center rounded-full bg-slate-200 px-3 py-1 text-xs font-medium text-slate-700 hover:bg-slate-300">
                <?php echo esc_html($t->name); ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        </div>


      </header>
    </div>

    <?php if (has_post_thumbnail()) : ?>
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl ring-1 ring-slate-200 shadow-sm">
          <?php the_post_thumbnail('1536x1536', [
            'class' => 'w-full h-auto object-cover',
            'loading' => 'eager',
            'alt' => esc_attr(get_the_title()),
          ]); ?>
        </div>
      </div>
    <?php endif; ?>
  </section>

  <!-- Body -->

  <section class="relative">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
      <?php
      $content = get_the_content();
      if ('' !== trim($content)) : ?>
        <article class="prose prose-slate max-w-none bg-white rounded-3xl ring-1 ring-slate-200 shadow-sm p-6 sm:p-8">
          <?php
          the_content();

          // In case you use <!--nextpage--> pagination in content
          wp_link_pages([
            'before' => '<div class="mt-6 border-t pt-4 text-sm text-slate-600"><span class="font-medium">Pages:</span> ',
            'after'  => '</div>',
          ]);
          ?>

          <?php
          // Optional: Custom fields block example (uncomment if you use ACF/meta)
          /*
        $client = get_post_meta(get_the_ID(), 'client_name', true);
        $role   = get_post_meta(get_the_ID(), 'role', true);
        if ($client || $role): ?>
          <div class="not-prose mt-8 grid sm:grid-cols-2 gap-4">
            <?php if ($client): ?>
              <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200">
                <div class="text-xs uppercase tracking-wide text-slate-500">Client</div>
                <div class="mt-1 font-medium text-slate-900"><?php echo esc_html($client); ?></div>
              </div>
            <?php endif; ?>
            <?php if ($role): ?>
              <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200">
                <div class="text-xs uppercase tracking-wide text-slate-500">Role</div>
                <div class="mt-1 font-medium text-slate-900"><?php echo esc_html($role); ?></div>
              </div>
            <?php endif; ?>
          </div>
        <?php endif;
        */
          ?>
        </article>
      <?php endif; ?>

      <!-- Prev / Next -->
      <nav class="mt-8 flex items-center justify-between gap-4">
        <div class="flex-1">
          <?php $prev = get_previous_post(true, '', 'funnel_category'); // constrain within taxonomy 
          ?>
          <?php if ($prev): ?>
            <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="group inline-flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-slate-900">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-hover:-translate-x-0.5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
              </svg>
              <span><?php echo esc_html(get_the_title($prev)); ?></span>
            </a>
          <?php endif; ?>
        </div>
        <div class="flex-1 text-right">
          <?php $next = get_next_post(true, '', 'funnel_category'); ?>
          <?php if ($next): ?>
            <a href="<?php echo esc_url(get_permalink($next)); ?>" class="group inline-flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-slate-900">
              <span><?php echo esc_html(get_the_title($next)); ?></span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z" />
              </svg>
            </a>
          <?php endif; ?>
        </div>
      </nav>
    </div>
  </section>

  <!-- Related Funnels -->
  <?php
  // Pull 3 more from the primary category (exclude current)
  $related = null;
  if ($primary_term) {
    $related = new WP_Query([
      'post_type'           => 'funnel',
      'posts_per_page'      => 3,
      'post__not_in'        => [get_the_ID()],
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
      'tax_query' => [[
        'taxonomy' => 'funnel_category',
        'field'    => 'term_id',
        'terms'    => $primary_term->term_id
      ]],
    ]);
  }
  ?>

  <?php if ($related && $related->have_posts()) : ?>
    <section class="relative">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-14">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6">Related Funnels</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 gap-6">
          <?php while ($related->have_posts()) : $related->the_post(); ?>
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
              </div>
            </article>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php get_footer(); ?>