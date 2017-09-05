<?php

function generate_attendee_csv($export_event_id) {

  $all_attendees = TribeEventsTickets::get_event_attendees($export_event_id);
  $export_attendee_list = array();
  $counter = 0;
  $attendee_counter = 1;
  $old_order_id = 0;

  foreach($all_attendees as $attendee) {
    $order_id    = $attendee['order_id'];
    $order       = new WC_Order( $order_id );
    $order_meta  = get_post_meta($order_id);
    $_product_id = $attendee['product_id'];

    // Purchaser Name
    $purchaser_name = $order_meta['_billing_first_name'][0] . ' ' . $order_meta['_billing_last_name'][0];

    // Company
    $company = $order_meta['_billing_company'][0];

    // Address
    $address1 = $order_meta['_billing_address_1'][0];
    $address2 = $order_meta['_billing_address_2'][0];
    $address  = $address1.' '.$address2;

    // City, State & Zip
    $city  = $order_meta['_billing_city'][0];
    $state = $order_meta['_billing_state'][0];
    $zip   = $order_meta['_billing_postcode'][0];

    // Email
    $purchaser_email = $order_meta['_billing_email'][0];

    // Amount paid
    $amt_paid = $order->get_formatted_order_total();
    $amt_paid = html_entity_decode(strip_tags($amt_paid), ENT_QUOTES, 'utf-8');

    // Reset the counter after each order
    if ($old_order_id == 0) {
      $old_order_id = $order_id;
    } else {
      if ($order_id != $old_order_id) {
        $attendee_counter = 1;
        $old_order_id = $order_id;
      }
    }

    // Attendee Name, Attendee Email, Job Title, Dietary Restrictions & Phone
    //$attendee_name                 = get_post_meta( $order_id, 'attendee_name_'.$_product_id.'_'.$attendee_counter, true);
    $attendee_first_name           = get_post_meta( $order_id, 'attendee_first_name_'.$_product_id.'_'.$attendee_counter, true);
    if(empty($attendee_first_name)) {
        $attendee_first_name = get_post_meta( $order_id, 'attendee_name_'.$_product_id.'_'.$attendee_counter, true);
    }
    $attendee_last_name            = get_post_meta( $order_id, 'attendee_last_name_'.$_product_id.'_'.$attendee_counter, true);
    $attendee_email                = get_post_meta( $order_id, 'attendee_email_'.$_product_id.'_'.$attendee_counter, true);
    $attendee_job_title            = get_post_meta( $order_id, 'attendee_job_title_'.$_product_id.'_'.$attendee_counter, true);
    $attendee_dietary_restrictions = get_post_meta( $order_id, 'attendee_dietary_restrictions_'.$_product_id.'_'.$attendee_counter, true);
    $phone                         = $order_meta['_billing_phone'][0];

  	$discount                      = round($order_meta['_cart_discount'][0], 2);

    $coupons = $order->get_used_coupons();
    $coupon = $coupons[0];
    if ( !$coupon ) {
      $coupon = $discount = "";
    } else {
		  $discount = "$".$discount;
    }
    $export_attendee_list[$counter] = array(
      $purchaser_name,
      $phone,
      $company,
      $address,
      $city,
      $state,
      $zip,
      $purchaser_email,
      $amt_paid,
      //$attendee_name,
      $attendee_first_name,
      $attendee_last_name,
      $attendee_email,
      $attendee_company,
      $attendee_job_title,
      $attendee_dietary_restrictions,
      //$phone,
      $attendee_cell_phone,
      $attendee_work_phone,
	  $coupon,
	  $discount
    );
    $counter++;
    $attendee_counter++;

  }

  $event = get_post($export_event_id);

  if ( !empty($export_attendee_list) ) {

    $charset    = get_option( 'blog_charset' );
    $start_date = strtotime(get_post_meta($event, '_EventStartDate', true));
    $filename   = $event->post_name;

    // output headers so that the file is downloaded rather than displayed
    header( "Content-Type: text/csv; charset=$charset" );
    header( "Content-Disposition: attachment; filename=$filename-attendees.csv" );

    // create a file pointer connected to the output stream
    $output = fopen( 'php://output', 'w' );

    fputcsv($output, array(
      'Purchaser Name',
      'Purchaser Phone',
      'Purchaser Company',
      'Address',
      'City',
      'State',
      'Zip',
      'Purchaser Email',
      'Amount Paid',
      //'Attendee Name',
      'Attendee First Name',
      'Attendee Last Name',
      'Attendee Email',
      'Attendee Company',
      'Job Title',
      'Dietary Restrictions',
      'Cell Phone',
      'Work Phone',
      //'Phone',
	  'Coupon Code',
	  'Coupon Amount'
    ));

    foreach ( $export_attendee_list as $item ) {
      fputcsv( $output, $item );
    }

    fclose( $output );

    exit;

  }

}