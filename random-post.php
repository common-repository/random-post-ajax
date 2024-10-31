<?php

    /*
    Plugin Name: Random Post by Ajax
    Plugin URI: https://wpmen.ir
    Description: Combining beauty and efficiency to display random posts
    Author: WPMEN
    Version: 0.8.1
    Author URI: https://wpmen.ir
    Text Domain: random-post-ajax
    */
    /*-------------------------------------------------------------------------------------------------*/

    // Security Check
    if ( ! defined( 'ABSPATH' ) ) exit;

    // Set Define
    define('randompost_Version' , '0.8.1');
    define('randompost_CodeName', ' Lotfi A. Zadeh');
    define('randompost_CodeName_link', 'https://en.wikipedia.org/wiki/Lotfi_A._Zadeh');


    // Get Core file
    require_once('core.php');


    // i18n plugin domain
    define('RANDOM_POST_AJAX_I18N_DOMAIN', 'random-post-ajax');

    /* Initialise the internationalisation domain */
    load_plugin_textdomain(RANDOM_POST_AJAX_I18N_DOMAIN,'wp-content/plugins/duplicate-post/languages','random-post-ajax/languages');



        ?>
