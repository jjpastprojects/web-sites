<?php
/*
Plugin Name: BTCG Custom Data Exports
Description: Enables customized exports of attendee and financial data from WordPress database
Version: 1.1
Author: Braintrust Consulting Group
Text Domain: btcg-data-export
*/

// Check if The Events Calendar is active
if ( in_array ('the-events-calendar/the-events-calendar.php', apply_filters('active_plugins', get_option('active_plugins')) ) ) {

  // Adding submenu
  add_action('admin_menu', 'braintrust_custom_export_submenu');

  function braintrust_custom_export_submenu() {
    $where = 'edit.php?post_type=' . TribeEvents::POSTTYPE;
    $page_title = __( 'Export Class Data', 'btcg-class-export');
    $menu_title = __( 'CSV Export', 'btcg-class-export');
    $capability = 'edit_posts';

    if(isset($_POST['braintrust-export-attendees']) && $_POST['braintrust-export-attendees'] == 'export'){

      $export_event_id = $_POST['export_event_id'];

      include_once('attendees-export.php');

      if (intval($export_event_id) > 0) {
        generate_attendee_csv($export_event_id);
      }

    }

    if (isset($_POST['braintrust-export-financials']) && $_POST['braintrust-export-financials'] == 'export'){

      $export_event_id = $_POST['export_event_id'];

      include_once('financials-export.php');

      if(intval($export_event_id) > 0) {
        generate_financials_csv($export_event_id);
      }

    }

    add_submenu_page($where, $page_title, $menu_title, $capability, 'btcg-class-export', 'btcg_export_layout');

  }

  // WP-Admin Page Layout
  function btcg_export_layout() {
    include('admin-view.php');
  }

}
