<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
* Adds form in admin panel to choose which subcategories to hide from the sidebar
*/
if (!function_exists('show_product_categories_settings')) :
  function show_product_categories_settings()
    {
      ?>
      <div id="wpbody">
        <div id="wpbody-content">
          <div class="wrap">

          <?php // Check if WooCommerce is activated
            if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) :
          ?>
              <h1>Show Product Categories Settings</h1>
              <p>Here you can decide which product categories you want to exclude from displaying in the sidebar, you meanie.</p><hr>
              <h1>Included categories:</h1>
              <?php echo fetch_unblocked_categories_form();
                if(isset($_POST['add_to_blacklist'])) :
                    if (empty($_POST['added_category_name'])) :
                      echo '<p>Please select a category.</p>';
                    else:
                      add_categories_to_blacklist($_POST['added_category_name']);
                      refresh_page();
                  endif;
                endif;
              ?>
              <br>
              <hr>
              <h1>Excluded categories:</h1>
                <?php echo fetch_blocked_categories_form();
                  if(isset($_POST['remove_from_blacklist'])) :
                    if (empty($_POST['removed_category_name'])) :
                      echo '<p>Please select a category.</p>';
                    else:
                      remove_categories_from_blacklist($_POST['removed_category_name']);
                      refresh_page();
                    endif;
                  endif;
                else:
                  echo '<h1>Sorry, but I need WooCommerce in my life!</h1>';
              endif; ?>
          </div>
        </div>
      </div>
    <?php
  }

    add_action('admin_menu', function() {
      add_options_page('Show Product Categories Settings', 'Show Product Categories', 'manage_options', 'show-product-categories', 'show_product_categories_settings');
    });
endif;

/**
* Display error message if WooCommerce is inactive
*/
  if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) === false) :
    function show_category_error_notice()
    {
      ?>
        <div class="error notice">
          <p><?php _e( 'Show Product Categories needs Woocommerce to function :c', 'show_category_error_notice' ); ?></p>
        </div>
      <?php
    }
    add_action( 'admin_notices', 'show_category_error_notice' );
  endif;
