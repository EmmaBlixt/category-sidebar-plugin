<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
* Save the input data to the wp_hidden_categories table
* @param array[] $input catches input data from a select multiple form
*/
if (!function_exists('add_categories_to_blacklist')) :
  function add_categories_to_blacklist($input)
  {
    global $wpdb;
    foreach ($input as $category) :
      $categories = get_product_category_by_slug($category);
          $wpdb->insert('wp_hidden_categories', array(
          'term_name' => $categories['term_name'],
          'slug' => $categories['slug']
      ));
    endforeach;
  }
endif;

/**
* Delete input data from the wp_hidden_categories table
* @param array[] $input catches input data from a select multiple form
*/
if (!function_exists('remove_categories_from_blacklist')) :
  function remove_categories_from_blacklist($input)
  {
      global $wpdb;
      foreach ($input as $category) :
        $categories = get_product_category_by_slug($category);
            $wpdb->delete('wp_hidden_categories', array(
            'term_name' => $categories['term_name'],
            'slug' => $categories['slug']
        ));
      endforeach;
  }
endif;

/**
* Create table for blacklisting categories if it doesn't already exist
*/
function create_plugin_database_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hidden_categories';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
      `id` mediumint(9) NOT NULL AUTO_INCREMENT,
      `term_name` varchar(30) NOT NULL,
      `slug varchar(30) NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_plugin_database_table' );
