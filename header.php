<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 *
 * @version 5.3.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> dir="ltr">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $current_title = get_field('name', 'option');
    $logo = get_field('logo', 'option');
    $description = "Transform your restaurant experience with our dynamic QR Code Menu at LOGIX360 STUDIO. Designed for modern food businesses, our contactless digital menu streamlines ordering and enhances the dining experience with a secure, user-friendly interface."
        ?>
    <title><?php echo $current_title ? $current_title . ' - ' : "";
    bloginfo('name'); ?></title>

    <meta name="description"
        content="<?php echo get_the_excerpt() ? esc_attr(wp_strip_all_tags(get_the_excerpt())) : $description; ?>">
    <?php $card_background_color = get_field('card_background_color', 'option'); ?>
    <meta name="theme-color" content="<?php echo $card_background_color ? $card_background_color : '#fff' ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $current_title ? $current_title . ' - ' : "";
    bloginfo('name'); ?>" />
    <meta property="og:description"
        content="<?php echo get_the_excerpt() ? esc_attr(wp_strip_all_tags(get_the_excerpt())) : $description; ?>" />

    <meta property="og:url" content="<?php echo $current_url ?>" />
    <meta property="og:site_name" content="<?php echo bloginfo('name'); ?>">
    <meta property="og:image"
        content="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $logo ?>" />

    <?php wp_head(); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap"
        rel="stylesheet" />
</head>

<?php $theme_background_color = get_field('theme_background_color', 'option'); ?>

<body <?php body_class(); ?> style="background-color:<?php echo $theme_background_color; ?>">
    <main>