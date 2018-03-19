<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
* Fetch all blocked categories
* @return array[] $blocked_categories that contain all categories in the blacklist
*/
if (!function_exists('fetch_blocked_categories')) :
  function fetch_blocked_categories()
  {
    global $wpdb;
    $output = "";
    $blocked_categories = $wpdb->get_results( "SELECT * FROM wp_hidden_categories");
    return $blocked_categories;
  }
endif;

/**
* Fetch all categories
* @return array[] $product_categories that contain all categories
*/
if (!function_exists('fetch_all_categories')) :
  function fetch_all_categories()
  {
    $cat_args = array(
        'orderby'    => 'name',
        'order'      => 'asc',
        'hide_empty' => false,
    );
      $product_categories = get_terms('product_cat', $cat_args);
      return $product_categories;
  }
endif;

/**
* Fetch a WooCommerce category by slug and return it
* @param string $category_slug slug of the category we wish to find
* @return array[] $category values that contains category name & slug
*/
if (!function_exists('get_product_category_by_slug')) :
  function get_product_category_by_slug($category_slug)
  {
      $category = get_term_by('slug', $category_slug, 'product_cat', 'ARRAY_A');
      $category_values = array(
          'term_name' => $category['name'],
          'slug' => $category['slug'],
        );

      return $category_values;
  }
endif;

/**
* Refresh page after submitting the form
* Prevents users from submitting the same category more than once
*/
if (!function_exists('refresh_page')) :
  function refresh_page()
  {
      $location = '/wp-admin/options-general.php?page=show-product-categories';
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
  }
endif;
