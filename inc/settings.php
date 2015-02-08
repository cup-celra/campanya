<?php
/**
 * Theme Options
 */
function setup_theme_admin_menus() {
  // add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function)
  add_menu_page('Opcions del tema', 'Campanya', 'manage_options', 
        'campanya_theme_options', 'theme_settings_page');
}

function campanya_options_for_settings() {
  return array('email', 'phone', 'twitter', 'facebook', 'youtube', 'flickr');
}

function theme_settings_page() {
  // Check that the user is allowed to update options
  if ( ! current_user_can('manage_options') ) {
      wp_die('You do not have sufficient permissions to access this page.');
  }

  $options = campanya_options_for_settings();

  foreach ($options as $option) {
    $$option = get_option("theme_option_{$option}");
  }

  // Save options
  if (isset($_POST["update_settings"])) {

    foreach ($options as $option) {
      update_option("theme_option_{$option}", esc_attr($_POST[$option]));
      ?>
        <div id="message" class="updated">Settings saved</div>
      <?php
    }
  }

  ?>

  <div class="wrap">
      <?php screen_icon('themes'); ?> <h2>Contact Details</h2>

      <form method="POST" action="">
          <table class="form-table">
              <tr valign="top">
                  <th scope="row">
                      <label for="email">
                        Email:
                      </label> 
                  </th>
                  <td>
                      <input type="email" name="email" value="<?php echo $email;?>" />
                  </td>
              </tr>
              <tr valign="top">
                  <th scope="row">
                      <label for="phone">
                        Phone:
                      </label> 
                  </th>
                  <td>
                      <input type="text" name="phone" value="<?php echo $phone;?>"/>
                  </td>
              </tr>
              <!-- Social networks -->
              <?php
                $networks = campanya_options_for_settings();
                /*
                  TODO: Això s'hauria de fer com toca
                */
                unset($networks[0], $networks[1]);
              ?>
              <?php foreach ( $networks as $n ): ?>
              <tr valign="top">
                  <th scope="row">
                      <label for="<?php echo $n; ?>">
                        <?php echo ucfirst($n); ?>:
                      </label> 
                  </th>
                  <td>
                      <input type="text" name="<?php echo $n; ?>" value="<?php echo $$n;?>" placeholder="http://example.com" />
                  </td>
              </tr>
            <?php endforeach; ?>
          </table>

          <p>
            <input type="hidden" name="update_settings" value="Y" />
            <input type="submit" value="Save settings" class="button-primary"/>
          </p>
      </form>
  </div>

  <?php
}

// This tells WordPress to call the function named "setup_theme_admin_menus"
// when it's time to create the menu pages.
add_action("admin_menu", "setup_theme_admin_menus");

