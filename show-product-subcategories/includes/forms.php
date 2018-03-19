<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
* Fetch all categories and print them into a miltiple select form
* @return string $form_output will create a form field when echoed
*/
if (!function_exists('fetch_unblocked_categories_form')) :
  function fetch_unblocked_categories_form()
  {
    $form_output = "";
    $blocked_categories = fetch_blocked_categories();
    $product_categories = fetch_all_categories();
    $found = false;

    if( !empty($product_categories) ) :
      $form_output = '<form method="post" action="" name="add_to_blacklist">';
      $form_output .= '<select multiple name="added_category_name[]" style="width: 300px; min-height: 200px">';
        foreach ($product_categories as $category) :
           $found = false;
           foreach ($blocked_categories as $blocked_category) :
              if ($category->name == $blocked_category->term_name) :
                   $found = true;
              endif;
           endforeach;
           if (!$found)
               $form_output .= '<option value="' . $category->slug . '""> ' . $category->name . '</option>';
        endforeach;
      $form_output .= '<input type="submit" value="Add to blacklist">';
      $form_output .= '<input type="hidden" name="add_to_blacklist" id="add_to_blacklist" value="true" />';
      $form_output .= '</select>';
      $form_output .= '</form>';
    endif;

    return $form_output;
  }
endif;

/**
* Fetch all blocked categories and print them into a miltiple select form
* @return string $form_output will create a form field when echoed
*/
if (!function_exists('fetch_blocked_categories_form')) :
  function fetch_blocked_categories_form()
  {
    $form_output = '<form method="post" action="" name="remove_from_blacklist">';
    $form_output .= '<select multiple name="removed_category_name[]" style="width: 300px; min-height: 200px">';
    $blocked_categories = fetch_blocked_categories();

    foreach ($blocked_categories as $blocked_category) :
      $form_output .= '<option value="' . $blocked_category->slug . '""> ' . $blocked_category->term_name . '</option>';
    endforeach;

    $form_output .= '</select>';
    $form_output .= '<input type="submit" value="Remove from blacklist">';
    $form_output .= '<input type="hidden" name="remove_from_blacklist" id="add_to_blacklist" value="true" />';
    $form_output .= '</form>';

    return $form_output;
  }
endif;
