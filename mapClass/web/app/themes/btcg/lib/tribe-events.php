<?php

/**
 * Use "Class" instead of "Event"
 */
add_filter( 'tribe_event_label_singular', 'event_display_name' );
function event_display_name() {
  return 'Class';
}

add_filter( 'tribe_event_label_plural', 'event_display_name_plural' );
function event_display_name_plural() {
  return 'Classes';
}

/**
 * Unhook plugin scripts
 */
function dequeue_tribe_events_scripts_and_styles() {
  wp_dequeue_script( 'tribe-events-pro-geoloc' );
  wp_dequeue_script( 'tribe-events-list' );
  wp_dequeue_script( 'tribe-events-pro' );
  wp_dequeue_script( 'tribe-events-calendar-script' );
  wp_dequeue_script( 'tribe-events-bar' );
  wp_dequeue_script( 'tribe-events-bootstrap-datepicker' );
  wp_dequeue_script( 'tribe-placeholder' );
  wp_dequeue_script( 'tribe-events-jquery-resize' );
}
add_action('wp_enqueue_scripts', 'dequeue_tribe_events_scripts_and_styles', 100);

/*
 * Expose Class data for AJAX consumption
 * via admin-ajax.php
 */

add_action( 'wp_ajax_nopriv_upcoming_classes', 'btcg_upcoming_classes' );
add_action( 'wp_ajax_upcoming_classes', 'btcg_upcoming_classes' );

function btcg_upcoming_classes() {
  global $wpdb;

  $args = array(
    'post_type'      => 'tribe_events',
    'posts_per_page' => -1
  );

  $classes_query = new WP_Query($args);
  $response = array();
  $classes = array();
  $categories = array();
  $markets = array();
  $taxonomy = 'tribe_events_cat';
  $terms = get_terms($taxonomy);

  if ( $classes_query->have_posts() ) {

    while ( $classes_query->have_posts() ) : $classes_query->the_post();

      // Event
      $id = get_the_id();
      $title = html_entity_decode(get_the_title());
      $permalink = get_the_permalink();
      $post_meta = get_post_meta($id);
      $price = $post_meta['price'][0];
      $early_price = $post_meta['early_bird_price'][0];
      $capacity = $post_meta['capacity'][0];
      $guaranteed = filter_var($post_meta['guaranteed_to_run'][0], FILTER_VALIDATE_BOOLEAN);
      $start = $post_meta['_EventStartDate'][0];
      $end = $post_meta['_EventEndDate'][0];
      $duration = round($post_meta['_EventDuration'][0] / (3600*24));
      $terms = get_the_terms($id, $taxonomy);
      $category_id = $terms[0]->term_id;
      $category_name = $terms[0]->name;
      $category_slug = $terms[0]->slug;
      $market = $post_meta['tour_location'][0];

      // Venue
      $venue_id = $post_meta['_EventVenueID'][0];
      $venue_meta = get_post_meta($venue_id);
      $lat = $venue_meta['_VenueLat'][0];
      $lng = $venue_meta['_VenueLng'][0];
      $venue_name = html_entity_decode(get_the_title($venue_id));
      $address = $venue_meta['_VenueAddress'][0];
      $city = $venue_meta['_VenueCity'][0];
      $state = $venue_meta['_VenueStateProvince'][0];
      $zip = $venue_meta['_VenueZip'][0];

      // Market
      $market_id = (int)$post_meta['market'][0];
      $market_location = get_post_field('coordinates', $market_id);
      if ( isset($market_location['lat']) && isset($market_location['lng']) ) {
        $market_lat = (float)$market_location['lat'];
        $market_lng = (float)$market_location['lng'];
      }
      $market_city = get_post_field('city', $market_id);
      $market_state = get_post_field('state', $market_id);

      $classes[] = array(
        'id'             => $id,
        'title'          => $title,
        'permalink'      => $permalink,
        'price'          => $price,
        'early_price'    => $early_price,
        // 'guaranteed'     => $guaranteed,
        'start'          => $start,
        'end'            => $end,
        'duration'       => $duration,
        // 'venue'          => $venue_name,
        'city'           => $city,
        'state'          => $state,
        'zip'            => $zip,
        'category_id'    => $category_id,
        'market_id'      => $market_id,
        'market_lat'     => $market_lat,
        'market_lng'     => $market_lng
      );

      $category_count = $categories[$category_id]['count'];

      if ( isset($category_count) ) {
        $category_count = $category_count+=1;
      } else {
        $category_count = 1;
      }

      if ( isset($category_id) ) {
        $categories[$category_id] = array(
          'name' => $category_name,
          'id' => $category_id,
          'slug' => $category_slug,
          'total_classes' => $category_count
        );
      }

      if ( isset($market_count) ) {
        $market_count = $market_count+=1;
      } else {
        $market_count = 1;
      }

      if ( isset($market_id) && $market_id != 0 ) {
        $markets[$market_id] = array(
          'id' => $market_id,
          'total_classes' => $market_count,
          'lat' => (float)$market_location['lat'],
          'lng' => (float)$market_location['lng'],
          'city' => $market_city,
          'state' => $market_state
        );
      }

    endwhile;

    $response[] = array(
      'categories' => $categories,
      'markets' => $markets,
      'classes' => $classes
    );

    wp_send_json( $response );

    die();

  } else {

    die();

  }

}

