<?php
/**
 * Flash
 */

/**
 * WordPress Sessions
 * Make sure we can set variables into $_SESSION
 */
function aina_session_start() {
  if ( ! session_id() ) {
    session_start();
  }
}

function aina_session_end() {
  if ( session_id() ) {
    session_destroy();
  }
}

add_action('init', 'aina_session_start', 1);
add_action('wp_logout', 'aina_session_end');
add_action('wp_login', 'aina_session_end');

/**
 * Set Flash
 * Set a temporal flash message
 * @param string | string 
 */
function set_flash($key, $message) {
  $_SESSION[$key] = $message;
}

/**
 * Is Flash ?
 * Know whether a flash message is set or not
 * @param string
 * @return bool
 */
function is_flash($key) {
  return isset($_SESSION[$key]);
}

/**
 * Is Flash Error ?
 * Know whether a flash message is informing about an error
 * @param string
 * @return bool
 */
function is_flash_error($key) {
  if ( isset($_SESSION[$key.'-error']) and $_SESSION[$key.'-error'] === true ) {
    return true;
  }
  return false;
}

/**
 * The Flash
 * Print a flash message and remove it afterwards
 * @param string
 * @return mix 
 */
function the_flash($key) {
  if ( isset($_SESSION[$key]) ) {
    echo $_SESSION[$key];
    unset($_SESSION[$key]);
    // Check if an error flash was set too
    if ( isset($_SESSION[$key.'-error']) ) {
      unset($_SESSION[$key.'-error']);
    }
  }
}


