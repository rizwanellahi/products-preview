<?php
// Assigning the brand color to a variable.
$borderColor = get_field('brand_color', 'option');

/**
 * Convert a HEX color code to an array of RGB values.
 *
 * @param string $hexColor A hexadecimal color code (e.g. "#fff", "#ffffff", "fff", "ffffff").
 * @return array An associative array with 'r', 'g', and 'b' keys.
 */
function hexToRgb($hexColor)
{
    // Remove '#' if present
    $hexColor = ltrim($hexColor, '#');

    // If it's a 3-character hex, expand it to 6 characters
    if (strlen($hexColor) === 3) {
        $hexColor = str_repeat(substr($hexColor, 0, 1), 2)
            . str_repeat(substr($hexColor, 1, 1), 2)
            . str_repeat(substr($hexColor, 2, 1), 2);
    }

    // Extract the three pairs using substr, then convert to decimal
    $r = hexdec(substr($hexColor, 0, 2));
    $g = hexdec(substr($hexColor, 2, 2));
    $b = hexdec(substr($hexColor, 4, 2));

    return [
        'r' => $r,
        'g' => $g,
        'b' => $b
    ];
}

// Example usage:
$rgb1 = hexToRgb($borderColor);
$rgb1String = $rgb1['r'] . ',' . $rgb1['g'] . ',' . $rgb1['b'];



?>

<style>
    :root {
        --brand-color:
            <?php echo esc_attr($borderColor); ?>
        ;
        --brand-color-rgb:
            <?php echo esc_attr($rgb1String); ?>
        ;
    }
</style>