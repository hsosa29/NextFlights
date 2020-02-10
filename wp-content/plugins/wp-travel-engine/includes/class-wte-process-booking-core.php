<?php 
/**
 * Process the booking flow in WP Travel Engine.
 * 
 * @package WP_Travel_Engine
 * @since 2.2.8  
 */
/**
 * Main Booking process handler class.
 */
class WTE_Process_Booking_Core {

    /**
     * Handle the booking process after the booking request form is submitted from checkout.
     *
     * @return void
     */
    public function process_booking() {

        if (
            ! isset( $_POST['action'] )
            || 'wp_travel_engine_new_booking_process_action' !== $_POST['action']
            || ! isset( $_POST['wp_travel_engine_nw_bkg_submit'] )
            || ! isset( $_POST['wp_travel_engine_new_booking_process_nonce'] )
            || ! wp_verify_nonce( $_POST['wp_travel_engine_new_booking_process_nonce'], 'wp_travel_engine_new_booking_process_nonce_action' )
        ) {
            return;
        }

        global $wte_cart;

        $cart_items = $wte_cart->getItems();
        $cart_total = $wte_cart->get_total();

        if ( empty( $cart_items ) ) {
            return;
        }

        foreach( $cart_items as $key => $cart_item ) :

            $post        = get_post( $cart_item['trip_id'] );
            $slug        = $post->post_title;
            $pax         = isset( $cart_item['pax'] ) ? $cart_item['pax'] : array();

            $payment_mode = isset( $_POST['wp_travel_engine_payment_mode'] ) ? $_POST['wp_travel_engine_payment_mode'] : 'full_payment';
            $due          = 'partial' == $payment_mode ? wp_travel_engine_get_formated_price( $cart_total['total'] - $cart_total['total_partial'] ) : 0;
            $total_paid   = 'partial' == $payment_mode ? wp_travel_engine_get_formated_price( $cart_total['total_partial'] ) : wp_travel_engine_get_formated_price( $cart_total['total'] );

            $order_metas = array(
                'place_order' => array(
                    'traveler' => esc_attr( array_sum( $pax ) ),
                    'cost'     => esc_attr( $total_paid ),
                    'due'      => esc_attr( $due ),
                    'tid'      => esc_attr( $cart_item['trip_id'] ),
                    'tname'    => esc_attr( $slug ),
                    'datetime' => esc_attr( $cart_item['trip_date'] ),
                    'booking'  => array(
                        'fname'   => esc_attr( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['fname'] ),
                        'lname'   => esc_attr( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['lname'] ),
                        'email'   => esc_attr( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['email'] ),
                        'address' => esc_attr( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['address'] ),
                        'city'    => esc_attr( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['city'] ),
                        'country' => esc_attr( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['country'] ),
                        'survey'  => isset( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['survey'] ) ? esc_attr( $_POST['wp_travel_engine_booking_setting']['place_order']['booking']['survey'] ):'',
                    ),
                )
            );

            if( isset( $order_metas ) && is_array( $order_metas ) ) :
				
                global $wpdb;
                
				$new_post = array(
					'post_status'   => 'publish',
					'post_type' 	=> 'booking',
					'post_title' 	=> 'booking',
                    );

				$booking_id = wp_insert_post( $new_post );
				
				if ( ! is_wp_error( $booking_id ) ) :

					/**
					 * @action_hook wte_created_user_booking
					 * 
					 * @since 2.2.0
					 */
					do_action( 'wte_after_booking_created', $booking_id );

				endif;

				$book_post = array(
                    'ID'           => $booking_id,
                    'post_title'   => 'booking '.$booking_id,
                );

				// Update the post into the database
				$updated     = wp_update_post( $book_post );
				$bid[]       = $booking_id;
                $order_metas = array_merge_recursive( $order_metas, $bid );
                
                update_post_meta( $booking_id, 'wp_travel_engine_booking_payment_status', 'pending' );
                
                // Update the post meta data.
                update_post_meta( $booking_id, 'wp_travel_engine_booking_setting', $order_metas );

                $order_confirmation = new Wp_Travel_Engine_Order_Confirmation();

                $order_confirmation->insert_customer( $order_metas );

                if ( false === $updated ) _e( 'There was an error on update.','wp-travel-engine' );

				$email_class      = 'Wp_Travel_Engine_Mail_Template';
                $wte_email_object = apply_filters( 'mail_template_class', $email_class );
                
                // Send email to admin and customer.
				$wte_email_object = new $wte_email_object;
				$wte_email_object->mail_editor( $order_metas, $booking_id );

                // TODO replace $_SESSION['tid'] - ALL OVER 
                // $_SESSION['tid']  = esc_attr( $booking_id );

                /**
                 * Hook to handle payment process
                 * 
                 * @since 2.2.8
                 */
                do_action( 'wp_travel_engine_after_booking_process_completed', $booking_id );
            
            endif;

        endforeach;
        
        $wte_confirm  = wp_travel_engine_get_booking_confirm_url();
        $wte_confirm  = add_query_arg( 'booking_id', $booking_id, $wte_confirm );
        
        // Redirect to the traveller's information page.
        wp_safe_redirect( $wte_confirm );

        exit;

    }

}
