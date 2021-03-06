<?php

/**
 * Aina
 * Generated with Aina. Version 0.3.0
 */

/**
 * Include Custom Post-Types
 */
if ( function_exists( 'aina_post_types' ) ) {
  foreach ( aina_post_types() as $pt ) {
    require AINA_THEME_ROOT . 'post-types/' . $pt . '.php';
  }
}

/**
 * Add Post-Type Custom Fields
 */
function aina_add_custom_fields($post_type) {
    global $post;
    $custom = get_post_custom($post->ID);

    $add_custom_function = $post_type . '_custom_fields';

    $custom_fields = $add_custom_function();
  
    foreach ( $custom_fields as $field => $args ) {
        $value  = isset($custom[$field][0]) ? $custom[$field][0] : null;
        echo aina_custom_field_for($field, $value, $args);
    }
}

/**
 * Make sure we can save it
 */
function aina_save_custom($post_type) {
  global $post;

  // Is this a new post being created?
  if ( ! isset($post->ID) ) return;

  $add_custom_function = $post_type . '_custom_fields';

  $save_fields = $add_custom_function();
  
  foreach ( $save_fields as $field => $args ) {
    $value = null;
    if ( isset($_POST[$field]) ) {
        if ( is_array($_POST[$field]) ) {
            $value = $_POST[$field][0];
        } else {
            $value = $_POST[$field];
        }
    }
    update_post_meta($post->ID, $field, $value);
  }
}

/**
 * Get single custom fields
 */
function aina_get_field($post_type, $field = '') {
    global $post;
    $custom_fields = get_post_custom($post->ID);
    return isset($custom_fields[$field][0]) ? $custom_fields[$field][0] : false;
}

/**
 * Echo single custom fields
 * This is a wrapper for aina_get_field()
 */
function aina_field($post_type, $field = '') {
    echo aina_get_field($post_type, $field);
}

/**
 * Custom Field For
 */
function aina_custom_field_for($field, $value, $args = array()) {
  
  $return = '';

  if ( isset($args) && is_array($args) ) {
    
    // Is label set?
    if ( isset($args['label']) ) {
      $return .= "<label for='{$field}'>" . ucfirst($args['label']) . '</label><br />';
    } else {
      $return .= "<label for='{$field}'>" . ucfirst($field) . '</label><br />';
    }

    // Options
    $placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';

    // Is type set?
    if ( isset($args['type']) ) {
      switch ($args['type']) {
        // Simple inputs
        case 'text':
          $return .= '<input type="text" name="' . $field . '" id="' . $field . '" value="' . $value . '" placeholder="' . $placeholder . '" />';
          break;
        case 'url':
          $return .= '<input type="url" name="' . $field . '" id="' . $field . '" value="' . $value . '" placeholder="' . $placeholder . '" />';
          break;
        case 'email':
          $return .= '<input type="email" name="' . $field . '" id="' . $field . '" value="' . $value . '" placeholder="' . $placeholder . '" />';
          break;
        case 'datetime-local':
        case 'datetime':
          $return .= '<input type="datetime-local" name="' . $field . '" id="' . $field . '" value="' . $value . '" />';
          break;
        case 'textarea':
          $return .= '<textarea name="' . $field . '" id="' . $field . '" >' . $value . '</textarea>';
          break;

        // With options
        case 'radio':
        case 'checkbox':
          if ( isset($args['options']) && is_array($args['options']) ) {
            foreach ($args['options'] as $option) {
              $checked = $option == $value ? true : false;
              $is_checked = $checked == true ? 'checked' : '';
              $return .= '<input type="'. $args['type'] .'" name=" ' . $field . '[]" id="' . $field . '" value="' . $option . '" ' . $is_checked . '/> ' . $option;
            }
          }
          break;
        case 'select':
          if ( isset($args['options']) && is_array($args['options']) ) {
            $return .= '<select name="' . $field . '" id="' . $field . '">';
            foreach ($args['options'] as $option) {
              if ( $option == $value ) {
                $return .= '<option value="' . $option . '">' . $option . '</option>';
              }
            }
            foreach ($args['options'] as $option) {
              $return .= '<option value="' . $option . '">' . $option . '</option>';
            }
            $return .= '</select>';
          }
          break;
        default:
          # code...
          break;
      }
    }
  } else {
    $return .= "<label for='{$field}'>" . ucfirst($field) . '</label><br />';
    $return .= '<input type="text" name=" ' . $field . '" id="' . $field . '" value="' . $value . '" />';
  }

  return "<p id='meta-field-{$field}'>" . $return . '</p>';
}
