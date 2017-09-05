<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Disable Admin Bar for all users
 */
show_admin_bar(false);

/**
 * Specify ACF Options Page
 */
if ( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
  acf_set_options_page_title( __('Global Fields') );
}

/**
 * Gravity Forms
 */

/** Insert scripts in footer */
add_filter( 'gform_init_scripts_footer', '__return_true' );

/** Changes the default Gravity Forms AJAX spinner. */
add_filter( 'gform_ajax_spinner_url', __NAMESPACE__ . '\\spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
  return get_stylesheet_directory_uri() . '/dist/images/loading-white.gif';
}
