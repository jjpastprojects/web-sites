<?php
/*
Plugin Name: BTCG Custom Attendee Fields
Plugin URI: http://braintrust.com/
Description:
Author: Jared Hughes
Author URI: http://anchr.in/
Version: 1.0

Copyright: 2013 Dominic Tan
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Check if WooCommerce & WooTickets are active
 **/
if (
        in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) &&
        in_array( 'wootickets/wootickets.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
    ) {
		
	wp_enqueue_style( 'attendee-fields-css', plugins_url('attendee-fields.css', __FILE__) );
	
    /**
     * Add the field to the checkout
     **/
    add_action('woocommerce_after_order_notes', 'wt_attendee_details');
    function wt_attendee_details( $checkout ) {

        global $woocommerce;
        $attendee_count = 0;

        if (sizeof($woocommerce->cart->get_cart())>0) :
            foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
                $_product = $values['data'];
                if ($_product->exists() && $values['quantity']>0) :
                    if (get_post_meta($_product->id, '_tribe_wooticket_for_event', true) > 0) :
                        $attendee_count = $values['quantity'];
                        $event_id = get_post_meta( $_product->id, '_tribe_wooticket_for_event', true );
                        $start_date = date(strtotime(get_post_meta($event_id, '_EventStartDate', true)));
                        $end_date = date(strtotime(get_post_meta($event_id, '_EventEndDate', true)));

                        echo '<h3>'. date("n/j/y", $start_date) . ' &ndash; '. date("n/j/y", $end_date) .': '.__( get_the_title( $event_id ) ).'</h3>';
                        for($n = 1; $n <= $attendee_count; $n++ ) {

                            echo '<div class="additional-attendee-details additional-attendee-details-'. $n .'">';

                            // Name
                            /*
                            woocommerce_form_field( 'attendee_name_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('Name'),
                                'input_class'   => array('attendee-name-input'),
                                'required'      => true,
                            ), $checkout->get_value( 'attendee_name_'.$_product->id.'_'.$n ));
                            */

                            // First Name
                            woocommerce_form_field( 'attendee_first_name_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('First Name'),
                                'input_class'   => array('attendee-first-name-input'),
                                'required'      => true,
                            ), $checkout->get_value( 'attendee_first_name_'.$_product->id.'_'.$n ));

                            // Last Name
                            woocommerce_form_field( 'attendee_last_name_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-last'),
                                'label'         => __('Last Name'),
                                'input_class'   => array('attendee-last-name-input'),
                                'required'      => true,
                            ), $checkout->get_value( 'attendee_last_name_'.$_product->id.'_'.$n ));

                            // Email Address
                            woocommerce_form_field( 'attendee_email_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('Email Address'),
                                'input_class'   => array('attendee-email-input'),
                                'required'      => true,
                            ), $checkout->get_value( 'attendee_email_'.$_product->id.'_'.$n ));

							// Company Name
                            woocommerce_form_field( 'attendee_company_name_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('Company Name'),
                                'required'      => true,
                            ), $checkout->get_value( 'attendee_company_name_'.$_product->id.'_'.$n ));


                            // Job Title
                            woocommerce_form_field( 'attendee_job_title_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-last'),
                                'label'         => __('Job Title'),
                                'required'      => true,
                            ), $checkout->get_value( 'attendee_job_title_'.$_product->id.'_'.$n ));

                            // Dietary Restrictions
                            // woocommerce_form_field( 'attendee_dietary_restrictions_'.$_product->id.'_'.$n, array(
                                // 'type'          => 'text',
                                // 'class'         => array('form-row form-row-first'),
                                // 'label'         => __('Dietary Restrictions'),
                            // ), $checkout->get_value( 'attendee_dietary_restrictions_'.$_product->id.'_'.$n ));
							
							woocommerce_form_field( 'attendee_dietary_restrictions_'.$_product->id.'_'.$n, array(
                                'type'          => 'select',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('Dietary Restrictions'),
								'options'       => array(
													'None' 						=> __('None', 'woocommerce' ),
													'Vegetarian' 				=> __('Vegetarian', 'woocommerce' ),
													'Vegan' 					=> __('Vegan', 'woocommerce' ),
													'Gluten-Free' 				=> __('Gluten-Free', 'woocommerce' ),
													'Dairy-Free' 				=> __('Dairy-Free', 'woocommerce' ),
													'Peanut Allergy' 			=> __('Peanut Allergy', 'woocommerce' ),
													'Other: Please contact us' 	=> __('Other: Please contact us', 'woocommerce' )
								)
                            ), $checkout->get_value( 'attendee_dietary_restrictions_'.$_product->id.'_'.$n )); 
							
							 
                            // Primary Phone
                            woocommerce_form_field( 'attendee_primary_phone_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-last'),
                                'label'         => __('Primary Phone'),
                                'input_class'   => array('attendee-primary-phone-input'),
								'required'      => true,
                            ), $checkout->get_value( 'attendee_primary_phone_'.$_product->id.'_'.$n ));

                            // Work Phone
                            woocommerce_form_field( 'attendee_work_phone_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('Work Phone'),
                                'input_class'   => array('attendee-work-phone-input'),
                                'required'      => true
                            ), $checkout->get_value( 'attendee_work_phone_'.$_product->id.'_'.$n ));

                            // Address
                            woocommerce_form_field( 'attendee_address_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-last'),
                                'label'         => __('Address'),
                                'input_class'   => array('attendee-address-input'),
                            ), $checkout->get_value( 'attendee_address_'.$_product->id.'_'.$n ));

                            // City
                            woocommerce_form_field( 'attendee_city_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('City'),
                                'input_class'   => array('attendee-city-input'),
                            ), $checkout->get_value( 'attendee_city_'.$_product->id.'_'.$n ));

                            // State
                            woocommerce_form_field( 'attendee_state_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-last'),
                                'label'         => __('State'),
                                'input_class'   => array('attendee-state-input'),
                            ), $checkout->get_value( 'attendee_state_'.$_product->id.'_'.$n ));

                            // Zip
                            woocommerce_form_field( 'attendee_zip_'.$_product->id.'_'.$n, array(
                                'type'          => 'text',
                                'class'         => array('form-row form-row-first'),
                                'label'         => __('Zip'),
                                'input_class'   => array('attendee-zip-input'),
                            ), $checkout->get_value( 'attendee_zip_'.$_product->id.'_'.$n ));

                            echo '</div> <!--/.additional-attendee-details-->';

                            if($n != $attendee_count) {
                                echo '<div style="background:#cccccc; height:1px; margin-top:10px; margin-bottom:10px; clear:both;"></div>';
                            }

                        }
                    endif;
                endif;
            endforeach;
        endif;

    }

    /**
     * Process the checkout
     **/
    add_action('woocommerce_checkout_process', 'wt_attendee_fields_process');

    function wt_attendee_fields_process() {

        global $woocommerce;
        $attendee_count = 0;

        if (sizeof($woocommerce->cart->get_cart())>0) :
            foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
                $_product = $values['data'];
                if ($_product->exists() && $values['quantity']>0) :
                    if (get_post_meta($_product->id, '_tribe_wooticket_for_event', true) > 0) :
                        $attendee_count = $values['quantity'];
                        for($n = 1; $n <= $attendee_count; $n++ ) {
                            if (!$_POST['attendee_first_name_'.$_product->id.'_'.$n] || !$_POST['attendee_last_name_'.$_product->id.'_'.$n] || !$_POST['attendee_email_'.$_product->id.'_'.$n] || !$_POST['attendee_job_title_'.$_product->id.'_'.$n] || !$_POST['attendee_primary_phone_'.$_product->id.'_'.$n])
                                $error = true;
                                break;
							}
                            if($error) {
                                wc_add_notice('Please complete the attendeesss details.', 'error');
                            }
                    endif;
                endif;
            endforeach;
        endif;

    }

    /**
     * Update the order meta with field value
     **/
    add_action('woocommerce_checkout_update_order_meta', 'wt_attendee_update_order_meta');

    function wt_attendee_update_order_meta( $order_id ) {

        global $woocommerce;
        $attendee_count = 0;

        if (sizeof($woocommerce->cart->get_cart())>0) :
            foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
                $_product = $values['data'];
                if ($_product->exists() && $values['quantity']>0) :
                    if (get_post_meta($_product->id, '_tribe_wooticket_for_event', true) > 0) :
                        $attendee_count = $values['quantity'];
                        for($n = 1; $n <= $attendee_count; $n++ ) {
                            //if ($_POST['attendee_name_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_name_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_name_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_first_name_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_first_name_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_first_name_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_last_name_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_last_name_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_last_name_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_email_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_email_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_email_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_company_name_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_company_name_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_company_name_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_job_title_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_job_title_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_job_title_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_dietary_restrictions_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_dietary_restrictions_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_dietary_restrictions_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_primary_phone_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_primary_phone_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_primary_phone_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_work_phone_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_work_phone_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_work_phone_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_address_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_address_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_address_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_city_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_city_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_city_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_state_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_state_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_state_'.$_product->id.'_'.$n]));
                            if ($_POST['attendee_zip_'.$_product->id.'_'.$n]) update_post_meta( $order_id, 'attendee_zip_'.$_product->id.'_'.$n, esc_attr($_POST['attendee_zip_'.$_product->id.'_'.$n]));
                        }
                    endif;
                endif;
            endforeach;
        endif;

        /*
        $attendee_count = wt_count_attendees();
        for($n = 1; $n <= $attendee_count; $n++ ) {
            if ($_POST['attendee_name_'.$n]) update_post_meta( $order_id, 'Attendee Name '.$n, esc_attr($_POST['attendee_name_'.$n]));
            if ($_POST['attendee_email_'.$n]) update_post_meta( $order_id, 'Attendee Email '.$n, esc_attr($_POST['attendee_email_'.$n]));
        }
        */

    }

    function wt_count_attendees() {

        global $woocommerce;
        $attendee_count = 0;

        if (sizeof($woocommerce->cart->get_cart())>0) :
            foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
                $_product = $values['data'];
                if ($_product->exists() && $values['quantity']>0) :
                    if (get_post_meta($_product->id, '_tribe_wooticket_for_event') > 0)
                        $attendee_count += $values['quantity'];
                endif;
            endforeach;
        endif;

        return $attendee_count;

    }

    // Custom metabox to show the attendee details
    add_action( 'add_meta_boxes', 'ClassAttendee_Meta_Box');

    function ClassAttendee_Meta_Box() {

        global $wpdb, $post;
        $order_id = $post->ID;
        $order = new WC_Order( $order_id );
        $ordered_items = $order->get_items();
        foreach ($ordered_items as $item_id => $values) :
            $_product_id = $values['product_id'];
            if (get_post_meta($_product_id, '_tribe_wooticket_for_event', true) > 0) :
                add_meta_box(
                    'class-attendee-meta-box',
                    __('Class Attendees'),
                    'braintrust_class_attendee_list',
                    'shop_order',
                    'advanced',
                    'default'
                );
            endif;
        endforeach;
    }

    function braintrust_class_attendee_list($post) {
        global $wpdb;
        $order_id = $post->ID;
        $order = new WC_Order( $order_id );
        $ordered_items = $order->get_items();

        $tickets = TribeEventsTickets::get_event_tickets( $event_id );

        foreach ($ordered_items as $item_id => $values) :
            $_product_id = $values['product_id'];
            if (get_post_meta($_product_id, '_tribe_wooticket_for_event', true) > 0) :
                $event_id = get_post_meta( $_product_id, '_tribe_wooticket_for_event', true );
                echo '<h3>' . __( get_the_title( $event_id ) ) . '</h3>';
                echo '<table class="wp-list-table widefat fixed attendees">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" id="btcg_attendee" class="manage-column column-btcg_attendee" style="">First Name</th>';
                echo '<th scope="col" id="btcg_attendee" class="manage-column column-btcg_attendee" style="">Last Name</th>';
                echo '<th scope="col" id="btcg_attendee" class="manage-column column-btcg_attendee" style="">Email</th>';
                echo '<th scope="col" id="btcg_attendee" class="manage-column column-btcg_attendee" style="">Job Title</th>';
                echo '<th scope="col" id="btcg_attendee" class="manage-column column-btcg_attendee" style="">Dietary Restrictions</th>';
                echo '</tr>';
                echo '</thead>';
                $attendee_count = $values['qty'];
                if($attendee_count > 0) {
                    echo '<tbody id="the-list" data-wp-lists="list:attendee">';
                    $alternate_class = "alternate";
                    for($n = 1; $n <= $attendee_count; $n++ ) {
                        $alternate_class = ($n % 2 == 0) ? "" : "alternate";
                        echo '<tr class="'.$alternate_class.'">';
                        echo '<td>';
                        $first_name = get_post_meta( $order_id, 'attendee_first_name_'.$_product_id.'_'.$n, true);
                        if(empty($first_name)) {
                            $first_name = get_post_meta( $order_id, 'attendee_name_'.$_product_id.'_'.$n, true);
                        }
                        echo $first_name;
                        echo '</td>';
                        echo '<td>';
                        echo get_post_meta( $order_id, 'attendee_last_name_'.$_product_id.'_'.$n, true);
                        echo '</td>';
                        echo '<td>';
                        echo get_post_meta( $order_id, 'attendee_email_'.$_product_id.'_'.$n, true);
                        echo '</td>';
                        echo '<td>';
                        echo get_post_meta( $order_id, 'attendee_job_title_'.$_product_id.'_'.$n, true);
                        echo '</td>';
                        echo '<td>';
                        echo get_post_meta( $order_id, 'attendee_dietary_restrictions_'.$_product_id.'_'.$n, true);
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                }
                echo '</table>';
            endif;
        endforeach;
    }
}

?>