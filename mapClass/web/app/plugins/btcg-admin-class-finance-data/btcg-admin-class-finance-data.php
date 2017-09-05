<?php
/*
Plugin Name: BTCG Admin Class Finance Data
Description: Display Financial Data in WordPress Admin
Version: 1.0
Author: Braintrust Consulting Group
Text Domain: btcg-admin-class-finance-data
*/

add_action("load-tribe_events_page_tickets-attendees", "calculate_attendee_financial_Data");
function calculate_attendee_financial_Data() {
    global $value_to_display;
    // Load the ajax js in header after jquery
    wp_enqueue_script('btcg-attendees-finance-data', plugin_dir_url(__FILE__).'js/btcg-event-attendees-finance-data.js', array('jquery'), false, false);

    // Get Event ID and load the event tickets
    $current_event_id = isset( $_GET['event_id'] ) ? intval( $_GET['event_id'] ) : 0;
    //$current_event = get_post( $current_event_id );
    $current_event_tickets = TribeEventsTickets::get_event_tickets( $current_event_id );

    // Getting Ticket Ids
    $ticket_ids = array();
    foreach($current_event_tickets as $current_event_ticket) {
        $ticket_ids[] = $current_event_ticket->ID;
    }

    // Fetching all orders and searching the ticket id in the orders
    $attendees_list = TribeEventsTickets::get_event_attendees( $current_event_id );
    $amount_sold_online = 0;
    $amount_sold_offline = 0;
    foreach($attendees_list as $attendee) {
        $current_order_id = $attendee['order_id'];
        $order_details = new WC_Order( $current_order_id ); // Getting order detail
        $current_order_items = $order_details->get_items(); // Getting line items in the order
        $current_orderpayment_method = get_post_meta( $current_order_id, '_payment_method', true); // Get payment method
        $offline_methods = array('bacs', 'cod', 'cheque');
        $online_methods = array('paypal', 'simplify_commerce', 'authorize_net_cim_credit_card', 'authorize_net_cim_echeck');

        foreach($current_order_items as $current_order_item) {
            if(in_array($current_order_item['product_id'], $ticket_ids)) {
                if(in_array($current_orderpayment_method, $offline_methods)) {
                    $amount_sold_offline = $amount_sold_offline + $current_order_item['line_total'];
                }

                if(in_array($current_orderpayment_method, $online_methods)) {
                    $amount_sold_online = $amount_sold_online + $current_order_item['line_total'];
                }
            }
        }
    }


    $value_to_display  = '<strong>Online Sales:</strong> ' . wc_price($amount_sold_online) . '<br/>';
    $value_to_display .= '<strong>Offline Sales:</strong> ' . wc_price($amount_sold_offline) . '<br/>';
    $value_to_display .= '<strong>Gross Sales:</strong> ' . wc_price($amount_sold_offline + $amount_sold_online);

    // Adding inline javascript
    add_action('admin_head', 'attendees_inline_js');
}

function attendees_inline_js() {
    global $value_to_display;
	echo "<script type='text/javascript'>\n";
	echo "show_attendee_finance_data('".$value_to_display ."');";
	echo "\n</script>";
}