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
// require_once locate_template('controllers/settings.php');
require_once locate_template('controllers/enqueue.php');
// require_once locate_template('controllers/components.php');
require_once locate_template('controllers/cleanup.php');

/*-----------------------------------------------------------------------------------*/
/* Load required files  */
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* Production Use Only - wp-config.php  */
/*-----------------------------------------------------------------------------------*/
/**
 * Disable the Appearance > Theme File Editor and Plugin Editor
 */
// define( 'DISALLOW_FILE_EDIT', true );
// define( 'DISALLOW_FILE_MODS', true );




// Login logo + minor tweaks
add_action('login_enqueue_scripts', function () {
    // Path to your logo inside the theme
    $rel_path = 'logo.png'; // or .png
    $logo_url  = get_theme_file_uri($rel_path);
    $logo_file = get_theme_file_path($rel_path);

    // Cache-bust if the file exists
    if (file_exists($logo_file)) {
        $logo_url = add_query_arg('v', filemtime($logo_file), $logo_url);
    }

    // Adjust width/height to your image’s aspect
    $w = 200;  // px
    $h = 100;   // px

    echo '<style>
      .login h1 a {
        background-image: url("'. esc_url($logo_url) .'");
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        width: '. intval($w) .'px;
        height: '. intval($h) .'px;
      }
      /* Optional: button + focus styles to match your brand */
      .login .button-primary {
        // border-color: #111827;
        // background: #111827;
        // box-shadow: none;
        // text-shadow: none;
      }
      .login .button-primary:hover {
        // background: #0f172a;
        // border-color: #0f172a;
      }
    </style>';
});

// Make the logo link to your site instead of wordpress.org
add_filter('login_headerurl', function () {
    return home_url('/');
});

// Make the logo title attribute your site name
add_filter('login_headertext', function () {
    return get_bloginfo('name');
});