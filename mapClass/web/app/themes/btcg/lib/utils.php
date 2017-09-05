<?php

namespace Roots\Sage\Utils;

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function get_search_form() {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', __NAMESPACE__ . '\\get_search_form');


/**
 * Truncate string
 */
function limit_chars( $text, $n ){
  if ( strlen ( $text ) > $n ){
    return substr( $text, 0, $n ) . '&hellip;';
  } else {
    return $text;
  }
  return $text;
}