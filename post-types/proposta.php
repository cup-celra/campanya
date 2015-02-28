<?php

/**
 * Custom Post Type: Proposta
 * Generated with Aina. Version 0.3.0
 */

/* Proposta Properties */
function proposta_register() {
  $labels = array(
    'name'                  => _x("Propostes", 'proposta'),
    'singular_name'         => _x("Proposta", 'proposta'),
    'add_new'               => _x('Nova Proposta', 'proposta'),
    'add_new_item'          => __('Afegeix una Proposta'),
    'edit_item'             => __('Edita la Proposta'),
    'new_item'              => __('Nova Proposta'),
    'view_item'             => __('Veure Proposta'),
    'search_items'          => __('Cerca Propostes'),
    'not_found'             => __('No hem trobat res'),
    'not_found_in_trash'    => __('No hem trobat res a la brossa'),
    'parent_item_colon'     => '',
  );
  $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'query_var'             => true,
    'menu_icon'             => false, // get_stylesheet_directory_uri() . '/your_pt_icon_here.png'
    'rewrite'               => true,
    'capability_type'       => 'post',
    'hierarchical'          => true,
    'has_archive'           => true,
    'menu_position'         => null,
    'supports'              => array('title','editor'),
  ); 
  register_post_type( 'proposta' , $args );
}

add_action('init', 'proposta_register');


/* Proposta Taxonomy */
add_action( 'init', 'register_taxonomy_propostacategories' );

function register_taxonomy_propostacategories() {
  // Taxonomy slug
  $proposta_taxonomy = 'propostacategories';

  $labels = array( 
    'name'                       => _x( 'Categoria', $proposta_taxonomy ),
    'singular_name'              => _x( 'Categories', $proposta_taxonomy ),
    'search_items'               => _x( 'Search Proposta Category', $proposta_taxonomy ),
    'popular_items'              => _x( 'Popular Proposta Category', $proposta_taxonomy ),
    'all_items'                  => _x( 'All Proposta Category', $proposta_taxonomy ),
    'parent_item'                => _x( 'Parent Proposta Category', $proposta_taxonomy ),
    'parent_item_colon'          => _x( 'Parent Proposta Category:', $proposta_taxonomy ),
    'edit_item'                  => _x( 'Edit Proposta Category', $proposta_taxonomy ),
    'update_item'                => _x( 'Update Proposta Category', $proposta_taxonomy ),
    'add_new_item'               => _x( 'Add New Proposta Category', $proposta_taxonomy ),
    'new_item_name'              => _x( 'New Proposta Category', $proposta_taxonomy ),
    'separate_items_with_commas' => _x( 'Separate Proposta Categories with commas', $proposta_taxonomy ),
    'add_or_remove_items'        => _x( 'Add or remove Proposta Categories', $proposta_taxonomy ),
    'choose_from_most_used'      => _x( 'Choose from the most used Proposta Categories', $proposta_taxonomy ),
    'menu_name'                  => _x( 'Categories', $proposta_taxonomy ),
  );

  $args = array( 
    'labels'                => $labels,
    'public'                => true,
    'show_in_nav_menus'     => true,
    'show_ui'               => true,
    'show_tagcloud'         => true,
    'show_admin_column'     => true,
    'hierarchical'          => true,
    //'update_count_callback' => '',
    'rewrite'               => array( 'hierarchical' => true ), // Use taxonomy as categories
    'query_var'             => true
  );

  register_taxonomy( $proposta_taxonomy, array('proposta'), $args );
}

/**
 * Displays the Proposta post type icon in the dashboard
 */
//add_action( 'admin_head', 'proposta_icon' );
function proposta_icon() {
  echo '<style type="text/css" media="screen">
          #menu-posts-projecte .wp-menu-image {
              background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/proposta-icon.png) no-repeat 6px 6px !important;
          }
          #menu-posts-projecte:hover .wp-menu-image, #menu-posts-projecte.wp-has-current-submenu .wp-menu-image {
              background-position:6px -16px !important;
          }
          #icon-edit.icon32-posts-projecte {
              background: url(<?php echo get_stylesheet_directory_uri(); ?>/img/proposta-32x32.png) no-repeat;
          }
      </style>';
}

/**
 * Custom data fields
 * Add these custom fields to the proposta post type
 * IMPORTANT: Thou shalt not rename this function, or bad things may happen
 */
if ( ! function_exists( 'proposta_custom_fields' ) ) {
  function proposta_custom_fields() {
    return array(
      'email' => array(
        'label'     => 'Adreça de correu electrònic <span class="required">*</span>',
        'type'      => 'email',
      ),
      'full_name' => array(
        'label'     => "Nom complet",
        'type'      => 'text',
      ),
      'address' => array(
        'label'     => "Adreça",
        'type'      => 'text',
      ),
      'wanna_help' => array(
        'label'     => "Vols unir-te al grup de treball d'aquest àmbit?",
        'type'      => 'checkbox',
        'options'   => array( 'yes' => __('Sí') ),
      ),
//      'keep_updated' => array(
//        'label'     => "Vols rebre informació sobre l'estat de la proposta?",
//        'type'      => 'checkbox',
//        'options'   => array( 'yes' => __('Sí') ),
//      ),
   );
  }
}

/**
 * Add meta box
 * add_meta_box( $id, $title, $callback, $post_type, $context, $priority );
 */
if ( ! function_exists('proposta_meta_box') ) {
  function proposta_meta_box(){
    add_meta_box("proposta_meta", "Extra", "add_proposta_custom_fields", "proposta", "normal", "low");
  }
  add_action("admin_init", "proposta_meta_box");
}

/**
 * Add Custom Fields
 */
if ( ! function_exists('add_proposta_custom_fields') ) {
  function add_proposta_custom_fields() {
      aina_add_custom_fields('proposta');
  }
}

/**
 * Make sure we can save it
 */
if ( ! function_exists('save_proposta_custom') ) {
  function save_proposta_custom() {
    aina_save_custom('proposta');
  }
  add_action('save_post', 'save_proposta_custom');
}
