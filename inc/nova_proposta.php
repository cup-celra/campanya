<?php
/**
 * TODO
 * Aquesta lògica s'hauria d'abstraure
 */

function accept_new_proposta() {
  if ( ! isset( $_POST['proposta-nonce'] ) )
    return;

  // Set errors so blank submissions are not saved
  // but let's do nothing with it, yet
  $errors = array();
  
  $to_validate = array('post_content', 'category');

  foreach ( $to_validate as $field ) {
    if ( empty($_POST[$field]) ) {
      $errors[] = $field;
      set_flash("{$field}-error", campanya_text("required_{$field}_field"));
    }
  }

  if ( count($errors) == 0 and wp_verify_nonce( $_POST['proposta-nonce'], 'proposta-submission' ) ) {
    $my_post = array(
      'post_title'    => wp_strip_all_tags($_POST['post_title']),
      'post_content'  => wp_strip_all_tags($_POST['post_content']),
      'post_type'     => 'proposta',
      'post_status'   => 'publish',
      'post_author'   => 1, // Always as admin
      );
    $post_id = wp_insert_post($my_post);

    // Add meta fields
    foreach ( proposta_custom_fields() as $meta_key => $array ) {
      $meta_value = is_array($_POST[$meta_key]) ? $_POST[$meta_key][0] : $_POST[$meta_key];
      add_post_meta($post_id, $meta_key, wp_strip_all_tags($meta_value), true);
    }

    // Add taxonomies
    wp_set_object_terms( $post_id, (int) $_POST['category'], 'propostacategories', false );
    // Add parent taxonomy
    $term = get_term( (int) $_POST['category'], 'propostacategories' );
    wp_set_object_terms( $post_id, $term->parent, 'propostacategories', true );

    set_flash('yeah', campanya_text('yeah'));

    wp_safe_redirect( '/' );
  } else {
    //wp_safe_redirect( $_POST['_wp_http_referer'] );
  }
}
add_action( 'init', 'accept_new_proposta' );

