<?php

/*
 * Custom Post Type:
 * Class Markets
 */

add_action( 'init', 'btcg_cpt_markets' );

function btcg_cpt_markets() {
  $labels = array(
    'name'               => _x( 'Markets', 'Markets' ),
    'singular_name'      => _x( 'Market', 'Market Location' ),
    'add_new'            => _x( 'New Market', 'Add New Market' ),
    'add_new_item'       => __( 'Add New Market' ),
    'edit_item'          => __( 'Edit Market' ),
    'new_item'           => __( 'New Market' ),
    'all_items'          => __( 'All Markets' ),
    'view_item'          => __( 'View Market' ),
    'search_items'       => __( 'Search Markets' ),
    'not_found'          => __( 'No Markets found' ),
    'not_found_in_trash' => __( 'No Markets found in the Trash' )
  );
  $args = array(
    'labels'             => $labels,
    'description'        => 'Markets',
    'supports'           => array('title'),
    'public'             => true,
    'rewrite'            => false,
    'publicly_queryable' => false,
    'has_archive'        => false
  );
  register_post_type( 'markets', $args );
}