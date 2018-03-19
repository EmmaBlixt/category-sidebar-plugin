<?php
defined('ABSPATH') or die('No script kiddies please!');

require_once 'admin-area.php';
require_once 'functions.php';
require_once 'forms.php';
require_once 'data.php';

/**
* Enqueue the plugin styling
*/
function register_subcategory_styles()
{
    wp_register_style('style', plugins_url('../css/style.css',__FILE__));
    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts','register_subcategory_styles');
