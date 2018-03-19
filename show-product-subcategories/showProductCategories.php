<?php
defined('ABSPATH') or die('No script kiddies please!');
require_once 'includes/setup.php';

/**
* Class to handle the product category sidebar
*/
class showProductCategories
{
  function __construct()
  {
    return $this->init();
    return $this->show_product_subcategories_settings();
  }

  /**
  * Initialize the class & add WooCommerce hooks
  */
  public function init()
  {
    add_action('woocommerce_before_single_product', array($this, 'show_product_categories'));
  }

  /**
  * Fetches a products categories & echoes them out in a cute little sidebar next to the product image
  * The category names are links to respective category
  */
    public function show_product_categories()
      {
        $product_id = get_queried_object_id();
        $product = get_queried_object();
        $categories = get_the_terms( $product_id , 'product_cat' );

        $output = '<div class="side-navigation">';
        $output .= '<div class="side-menu-container">';
        $output .= '<div class="single-product-side-menu">';
        $output .= '<p>';
        $output .= '<a href="' . esc_url(home_url('/')) . '">Home /</a>';
        $output .= $product->name;

        foreach ($categories as $category) :
          $found = false;
          foreach (fetch_blocked_categories() as $blocked_category) :
            if ($category->slug == $blocked_category->slug) :
              $found = true;
            endif;
          endforeach;
          if (!$found) :
            $output .= '<a href="' . esc_url(home_url('/product-category/' . $category->name)) . '">';
            $output .= $category->name;
            $output .= ' / </a>';
          endif;
        endforeach;

        $output .= $product->post_title;
        $output .= '</p>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        echo $output;
      }
}
