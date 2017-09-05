<?php

function generate_financials_csv($export_event_id) {
	$orders = TribeEventsTickets::get_event_attendees($export_event_id);
	$counter = 1;
	$export_financials = array();

	$temp_order_id = 0;
	$temp_product_id = 0;
	$temp_counter = 1;
	foreach($orders as $order) {
		$number           = $counter;
		$order_id         = $order['order_id'];
		$order_meta       = get_post_meta($order_id);
    $temp_product_id  = $order['product_id'];

		$ticket           = $order['ticket'];

		$purchase_date    = get_the_date( 'F j, Y g:i a', $order_id );	// $order_meta['_paid_date'][0];
		$purchaser_name   = $order_meta['_billing_first_name'][0] . ' ' . $order_meta['_billing_last_name'][0];
		$user_id          = $order_meta['_customer_user'][0];
		$purchaser_email  = $order_meta['_billing_email'][0];
		$purchaser_phone  = $order_meta['_billing_phone'][0];
		$company          = $order_meta['_billing_company'][0];
		$address1         = $order_meta['_billing_address_1'][0];
		$address2         = $order_meta['_billing_address_2'][0];
		$address          = $address1 . ', ' . $address2;
		$city             = $order_meta['_billing_city'][0];
		$state            = $order_meta['_billing_state'][0];
		$zip              = $order_meta['_billing_postcode'][0];

		$discount         = round($order_meta['_cart_discount'][0], 2);
		$total            = $order_meta['_order_total'][0];
		$payment_method   = $order_meta['_payment_method_title'][0];

		if($temp_order_id == $order_id && $temp_product_id == $order['product_id']){
			$temp_counter++;
		} else {
			$temp_counter = 1;
		}

    $attendee_first_name = $order_meta["attendee_first_name_".$temp_product_id."_".$temp_counter][0];
    if(empty($attendee_first_name)) {
        $attendee_first_name = $order_meta["attendee_name_".$temp_product_id."_".$temp_counter][0];
    }
    $attendee_last_name = $order_meta["attendee_last_name_".$temp_product_id."_".$temp_counter][0];
		$attendee_job = $order_meta["attendee_job_title_".$temp_product_id."_".$temp_counter][0];
		$attendee_phone = $order_meta["attendee_primary_phone_".$temp_product_id."_".$temp_counter][0];

		$order_cst       = new WC_Order( $order_id );


		$order_items = $order_cst->get_items();


		foreach ($order_items as $item_id => $values) {
			$attendee_count = $values['qty'];
			break;
		}

		$coupons = $order_cst->get_used_coupons();
		$coupon = $coupons[0];
		if ( !$coupon ) {
		  $coupon = "";
		}
		if ( $discount == 0 ) {
		  $discount = "";
		} else {
		  $discount = "$".$discount;
		}


		$export_financials[$counter] = array(
			$order_id,
			$purchase_date,
			$ticket,
			$user_id,
			$purchaser_name,
			$purchaser_email,
			$purchaser_phone,
			$company,
			$address,
			$city,
			$state,
			$zip,
      $attendee_first_name,
      $attendee_last_name,
			$attendee_job,
			$attendee_cell_phone,
      $attendee_work_phone,
			$attendee_count,
			$total,
			$payment_method,
			$coupon,
			$discount
		);
		$counter++;

		$temp_order_id = $order_id;
		$temp_product_id = $order['product_id'];


	}

  $event = get_post($export_event_id);

  if ( !empty($export_financials) ) {

    $charset  = get_option( 'blog_charset' );
    $start_date = strtotime(get_post_meta($event, '_EventStartDate', true));
    $filename = $event->post_name;

    // output headers so that the file is downloaded rather than displayed
    header( "Content-Type: text/csv; charset=$charset" );
    header( "Content-Disposition: attachment; filename=$filename-fiancial-data.csv" );

    // create a file pointer connected to the output stream
    $output = fopen( 'php://output', 'w' );


    fputcsv($output, array(
		'Order ID',
		'Purchase Date',
		'Ticket Name',
		'User ID',
		'Purchaser Name',
		'Purchaser Email',
		'Purchaser Phone',
		'Purchaser Company',
		'Address',
		'City',
		'State',
		'Zip',
    'Attendee First Name',
    'Attendee Last Name',
		'Job Title',
    'Cell Phone',
    'Work Phone',
		'Number of Tickets Purchased',
		'Total Paid',
		'Payment Method',
		'Coupon Code',
		'Discount Amount'
    ));


    // And echo the data
    foreach ( $export_financials as $item ) {
      fputcsv( $output, $item );
    }

    fclose( $output );
    exit;
  }

}
