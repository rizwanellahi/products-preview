<?php

$country = get_field('country_symbol', 'option');
$price_currency_color = get_field('price_currency_color', 'option');

$list = get_query_var('list', []);
$two_col = $list['two_column'];

$item = get_query_var('item', []); // Default to an empty array if not set
$item_price = $item['price'] ?? '';

$has_second_price = !empty($item['has_second_price']);
$item_price_label = $item['first_price_label'] ?? '';
$second_item_price = $item['second_price'] ?? '';
$second_item_price_label = $item['second_price_label'] ?? '';

$fill_color = $price_currency_color ? 'var(--brand-color)' : '#000000';

$saudi_currency_symbol = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1124.14 1256.39" class="size-4 inline">
  <path fill="$fill_color" d="M699.62,1113.02h0c-20.06,44.48-33.32,92.75-38.4,143.37l424.51-90.24c20.06-44.47,33.31-92.75,38.4-143.37l-424.51,90.24Z"/>
  <path fill="$fill_color" d="M1085.73,895.8c20.06-44.47,33.32-92.75,38.4-143.37l-330.68,70.33v-135.2l292.27-62.11c20.06-44.47,33.32-92.75,38.4-143.37l-330.68,70.27V66.13c-50.67,28.45-95.67,66.32-132.25,110.99v403.35l-132.25,28.11V0c-50.67,28.44-95.67,66.32-132.25,110.99v525.69l-295.91,62.88c-20.06,44.47-33.33,92.75-38.42,143.37l334.33-71.05v170.26l-358.3,76.14c-20.06,44.47-33.32,92.75-38.4,143.37l375.04-79.7c30.53-6.35,56.77-24.4,73.83-49.24l68.78-101.97v-.02c7.14-10.55,11.3-23.27,11.3-36.97v-149.98l132.25-28.11v270.4l424.53-90.28Z"/>
</svg>
SVG;


if ('Bahrain' === $country) {
    $currency = is_rtl() ? 'د.ب' : 'BD';
} elseif ('Saudi Arabia' === $country) {
    $currency = is_rtl() ? $saudi_currency_symbol : $saudi_currency_symbol;
} elseif ('Oman' === $country) {
    $currency = 'OMR';
} elseif ('United Arab Emirates' === $country) {
    $currency = is_rtl() ? 'درهم' : 'AED';
} elseif ('Qatar' === $country) {
    $currency = is_rtl() ? 'ر.ق' : 'QR';
} elseif ('United States' === $country) {
    $currency = '$';
} elseif ('Kuwait' === $country) {
    $currency = is_rtl() ? 'د.ك' : 'KWD';
}

?>

<?php if ($has_second_price): ?>
    <div
        class="flex mt-1 sm:mt-2 <?php echo $two_col ? "flex-col sm:flex-row gap-0 sm:gap-2 gap-y-1" : "flex-row gap-2" ?>">
        <div class="leading-none flex flex-row items-center gap-1">
            <?php if ($item_price_label): ?>
                <small><?php echo $item_price_label ?></small>
            <?php endif; ?>
            <span class="font-medium brand-color">
                <?php echo esc_html($item_price); ?>
                <?php echo $currency; ?></span>
        </div>
        <div class="leading-none">
            <?php if ($second_item_price_label && $second_item_price): ?>
                <small><?php echo $second_item_price_label ?></small>
            <?php endif; ?>
            <?php if ($second_item_price): ?>
                <span class="font-medium"><?php echo esc_html($second_item_price); ?></span>
            <?php endif; ?>
            <?php if ($second_item_price): ?>
                <?php echo $currency; ?>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <?php if ($item_price): ?>
        <div class="text-base">
            <span
                class="font-medium <?php echo $price_currency_color ? 'brand-color' : ''; ?>"><?php echo esc_html($item_price); ?></span>
            <span class="font-medium">
                <?php echo $currency; ?>
            </span>
        </div>
    <?php endif; ?>
<?php endif ?>