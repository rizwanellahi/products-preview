<?php
/* taxonomy-funnel_category.php */
get_header();

$term = get_queried_object();
?>

<main id="primary" class="min-h-screen bg-slate-50">
  <section class="relative">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
      <!-- Breadcrumbs -->
      <nav class="text-sm text-slate-600 mb-4">
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:underline">Home</a>
        <span class="mx-2">/</span>
        <a href="<?php echo esc_url( get_post_type_archive_link('funnel') ); ?>" class="hover:underline">Funnels</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900 font-medium"><?php single_term_title(); ?></span>
      </nav>

      <!-- Header -->
      <header class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
          <?php echo esc_html( single_term_title('', false) ); ?>
        </h1>
        <?php if ( term_description() ) : ?>
          <div class="prose prose-slate max-w-none mt-3 text-slate-700">
            <?php echo wp_kses_post( term_description() ); ?>
          </div>
        <?php endif; ?>
      </header>

      <?php if ( have_posts() ) : ?>
        <!-- Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 gap-6">
          <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class('group overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200 shadow-sm hover:shadow-md transition'); ?>>
              <a href="<?php the_permalink(); ?>" class="block">
                <div class="aspect-[16/10] w-full overflow-hidden">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('large', [
                      'class'   => 'h-full w-full object-cover transition group-hover:scale-[1.02]',
                      'loading' => 'lazy',
                      'alt'     => esc_attr( get_the_title() ),
                    ]); ?>
                  <?php else : ?>
                    <div class="h-full w-full bg-gradient-to-br from-slate-100 to-slate-200"></div>
                  <?php endif; ?>
                </div>
              </a>

              <div class="p-3 sm:p-5">
                            <h3 class="text-base sm:text-lg font-semibold leading-tight text-slate-900">
                  <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                </h2>

                <p class="mt-2 text-sm text-slate-600">
                  <?php
                    $excerpt = get_the_excerpt();
                    if (!$excerpt) {
                      $excerpt = wp_trim_words( wp_strip_all_tags( get_the_content('') ), 26, '…' );
                    }
                    echo esc_html( $excerpt );
                  ?>
                </p>

                <?php
                $post_terms = get_the_terms( get_the_ID(), 'funnel_category' );
                if ( $post_terms && ! is_wp_error( $post_terms ) ) : ?>
                  <div class="mt-4 flex flex-wrap gap-2">
                    <?php foreach ( $post_terms as $pt ) : ?>
                      <a href="<?php echo esc_url( get_term_link( $pt ) ); ?>"
                         class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 hover:bg-slate-200">
                        <?php echo esc_html( $pt->name ); ?>
                      </a>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </article>
          <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <nav class="mt-10">
          <?php
          the_posts_pagination([
            'mid_size'  => 1,
            'prev_text' => '<span class="inline-flex items-center rounded-xl border border-slate-200 px-3 py-1.5 text-sm hover:bg-slate-50">Previous</span>',
            'next_text' => '<span class="inline-flex items-center rounded-xl border border-slate-200 px-3 py-1.5 text-sm hover:bg-slate-50">Next</span>',
            'screen_reader_text' => 'Funnels navigation',
          ]);
          ?>
        </nav>
      <?php else : ?>
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
          <p class="text-slate-600">No funnels found in this category.</p>
          <a href="<?php echo esc_url( get_post_type_archive_link('funnel') ); ?>"
             class="mt-4 inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
            Back to all funnels
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>