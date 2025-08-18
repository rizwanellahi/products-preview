<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php');

// function dump(...$data)
// {
//     echo "<pre>";
//     array_map('print_r', $data);
//     die;
// }

add_theme_support('menus');
add_theme_support('post-thumbnails');

/*-----------------------------------------------------------------------------------*/
/* Controllers */
/*-----------------------------------------------------------------------------------*/
require_once locate_template('controllers/CPT/menu.php');
require_once locate_template('controllers/settings.php');
require_once locate_template('controllers/enqueue.php');
require_once locate_template('controllers/components.php');
require_once locate_template('controllers/cleanup.php');

/*-----------------------------------------------------------------------------------*/
/* Load required files  */
/*-----------------------------------------------------------------------------------*/
require_once('acf-style.php');


/*-----------------------------------------------------------------------------------*/
/* Production Use Only - wp-config.php  */
/*-----------------------------------------------------------------------------------*/
/**
 * Disable the Appearance > Theme File Editor and Plugin Editor
 */
// define( 'DISALLOW_FILE_EDIT', true );
// define( 'DISALLOW_FILE_MODS', true );