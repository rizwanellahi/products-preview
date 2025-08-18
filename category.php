<?php
/**
 * category.php
 *
 * Template for displaying restaurant_menu items by WP default categories
 */

get_header();

// 1) Get the current category object and build a custom query.
$category_obj  = get_queried_object();
$category_slug = $category_obj ? $category_obj->slug : '';

$country_symbol         = get_field('country_symbol', 'option');
$theme_background_color = get_field('theme_background_color', 'option');

$args = [
    'post_type'      => 'restaurant_menu',
    'posts_per_page' => -1,          // show all
    'post_status'    => 'publish',
    'orderby'        => 'date',      // <-- fixed
    'order'          => 'DESC',      // <-- added
    'tax_query'      => [
        [
            'taxonomy' => 'category', // using default WP categories
            'field'    => 'slug',
            'terms'    => $category_slug,
        ],
    ],
];

$query = new WP_Query($args);
?>

<div id="restaurant-menu" style="background-color:<?php echo esc_attr($theme_background_color); ?>">

  <?php
  // Custom header partial
  get_template_part('page-templates/menu-parts/header');
  ?>

  <div class="menu-list container">
    <?php if ($query->have_posts()) : ?>
      <ul class="menu-items">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
          <li class="menu-item">
            <a href="<?php echo esc_url(get_permalink()); ?>">
              <?php
              // Optional: thumbnail
              if (has_post_thumbnail()) {
                  echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', ['alt' => esc_attr(get_the_title())]);
              }
              ?>
              <span class="menu-item-title"><?php echo esc_html(get_the_title()); ?></span>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else : ?>
      <p><?php esc_html_e('No items found in this category.', 'your-textdomain'); ?></p>
    <?php endif; wp_reset_postdata(); ?>
  </div>

</div> <!-- #restaurant-menu -->

<?php
// Additional template parts or partials if needed
get_template_part('page-templates/menu-parts/info');
get_template_part('page-templates/menu-parts/footer');
get_template_part('page-templates/menu-parts/primary-color');

get_footer();