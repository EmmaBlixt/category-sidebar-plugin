<?php
   /*
   Plugin Name: Show Product Categories
   Plugin URI:
   description: Display WooCommerce product main category and it's subcategories in a cute sidebar next to the product image
   Author: Emma Blixt
   Author URI: https://standout.se
   */

defined('ABSPATH') or die('No script kiddies please!');
include_once 'showProductCategories.php';

$show_categories = new showProductCategories();
