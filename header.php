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

    <title><?php echo  bloginfo('name'); ?></title>
    <meta name="theme-color" content="<?php echo $card_background_color ? $card_background_color : '#fff' ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <main>