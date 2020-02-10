<?php
/**
* Class for enquiry form shortcodes.
*/
class WP_Travel_Engine_Enquiry_Form_Shortcodes
{
	
	function init()
	{
		add_action('wp_travel_engine_enquiry_form', array( $this, 'wpte_enquiry_form' ));
		add_action('wp_ajax_wte_enquiry_send_mail', array($this, 'wte_enquiry_send_mail') );
		add_action('wp_ajax_nopriv_wte_enquiry_send_mail', array($this, 'wte_enquiry_send_mail') );
	}

	//Enquiry form main function
	function wpte_enquiry_form() { 

		include_once WP_TRAVEL_ENGINE_ABSPATH . '/includes/lib/wte-form-framework/class-wte-form.php';

		$enquiry_form = new WP_Travel_Engine_Form();

		$enquiry_form_options = array(
			'form_title'      => __( 'You can send your inquiry via the form below.', 'wp-travel-engine' ),
			'form_title_attr' => 'h2',
			'action'          => '#',
			'multipart'       => true,
			'id'              => 'wte_enquiry_contact_form',
			'name'            => 'wte_enquiry_contact_form',
			'submit_button'   => array(
				'name'  => 'enquiry_submit_button',
				'id'    => 'enquiry_submit_button',
				'value' => __( 'Send Email', 'wp-travel-engine' ),
			)
		);

		$enquiry_form_fields = wp_travel_engine_get_enquiry_form_fields();

		$enquiry_form->init( $enquiry_form_options )->form_fields( $enquiry_form_fields )->template();
	}


	/**
	 * Sends mail to subscriber and admin. 
	 * 
	 * @since 3.0.0
	 */
	function wte_enquiry_send_mail()
	{
		$email = sanitize_email( $_POST['enquiry_email'] );
		
		$wp_travel_engine_settings = get_option( 'wp_travel_engine_settings',true );

		$name     = esc_attr( $_POST['enquiry_name'] );
		$country  = isset( $_POST['enquiry_country'] ) ? esc_attr( $_POST['enquiry_country'] ):'N/A';
		$contact  = esc_attr( $_POST['enquiry_contact'] );
		$adult    = isset( $_POST['enquiry_adult'] ) ? esc_attr( $_POST['enquiry_adult'] ):'N/A';
		$children = isset( $_POST['enquiry_children'] ) ? esc_attr( $_POST['enquiry_children'] ):'N/A';
		$message1 = esc_attr( $_POST['enquiry_message'] );
	    
	    if( $_POST['enquiry_email']=='' || !is_email($_POST['enquiry_email']) )
	    {
	    	$result['type'] = "failed";
			$result['message'] = __( "Please enter your valid email. Thank You.","wp-travel-engine" );
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			{
				$result = json_encode($result);
				echo $result;
			}
			exit;
	    }
	    
		$postid = get_post( $_POST['enquiry_pid'] );
		$slug   = $postid->post_name;

		$url                   = '<a href='.esc_url( get_permalink( $postid ) ).'>'.esc_attr( $slug ).'</a>';
		$subject               = isset( $wp_travel_engine_settings['query_subject'] ) ? $wp_travel_engine_settings['query_subject']: __( 'Enquiry received', 'wp-travel-engine' );

		$enquirer_tags         = array( '{enquirer_name}', '{enquirer_email}' );
		$enquirer_replace_tags = array( $name, $email );
		$subject               = str_replace( $enquirer_tags, $enquirer_replace_tags, $subject );
	   
	   	$admin_email = get_option( 'admin_email' );

	    $to = sanitize_email($admin_email);

	    $ipaddress = '';

	    if (getenv('HTTP_CLIENT_IP'))
	    {

	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    }
	    else if(getenv('HTTP_X_FORWARDED_FOR')){

	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    }
	    else if(getenv('HTTP_X_FORWARDED')){

	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    }
	    else if(getenv('HTTP_FORWARDED_FOR')){

	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    }
	    else if(getenv('HTTP_FORWARDED')){

	        $ipaddress = getenv('HTTP_FORWARDED');
	    }
	    else if(getenv('REMOTE_ADDR')){

	        $ipaddress = getenv('REMOTE_ADDR');
	    }
	    else{

	        $ipaddress = 'UNKNOWN';
	    }

	    
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'Reply-To: '.$email."\r\n" ;
		// Create email headers.
		$headers .= 'X-Mailer: PHP/' . phpversion();

	    $country = esc_attr( $_POST['enquiry_country'] );
	    $message = __("Name: ","wp-travel-engine"). $name.'<br/>';
	    $message.= __("Country: ","wp-travel-engine"). $country.'<br/>';
	    $message.= __("Trip: ",'wp-travel-engine'). $url.'<br/>';
	    $message.= __("Email: ","wp-travel-engine"). $email.'<br/>';
	    $message.= __("Contact: ",'wp-travel-engine'). $contact.'<br/>';
	    $message.= __("IP Address: ",'wp-travel-engine'). $ipaddress.'<br/>';
	    $message.= __("Adult: ","wp-travel-engine"). $adult.'<br/>';
	    $message.= __("Children: ",'wp-travel-engine'). $children.'<br/>';
	    $message.= __("Message: ",'wp-travel-engine'). $message1.'<br/>';

	    if ( strpos( $wp_travel_engine_settings['email']['emails'], ',') !== false ) {
	    	$wp_travel_engine_settings['email']['emails'] = str_replace(' ', '', $wp_travel_engine_settings['email']['emails']);
			$admin_emails = explode( ',', $wp_travel_engine_settings['email']['emails'] );
			foreach ( $admin_emails as $key => $value ) {
				$to = sanitize_email($value);
	    		$admin_sent = wp_mail( $to, esc_html( $subject ), $message, $headers );
			}
		}
		else{
			$wp_travel_engine_settings['email']['emails'] = str_replace(' ', '', $wp_travel_engine_settings['email']['emails']);
	    	$admin_sent = wp_mail( $to, esc_html( $subject ), $message, $headers );
		}

	    if ( isset( $wp_travel_engine_settings['email']['cust_notif'])  && $wp_travel_engine_settings['email']['cust_notif'] == '1' )
	    {
	    
	        $headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers .= 'Reply-To: '.$to."\r\n" ;

			// Create email headers.
			$headers .= 'X-Mailer: PHP/' . phpversion();
	        $subject = apply_filters('customer_enquiry_subject', 'Enquiry Sent.');

	        wp_mail( $email, $subject, $message, $headers );
	    }
		

	    if( $admin_sent==1 )
	    {	
	    	$new_post = array( 
			'post_title' => 'enquiry ',
			'post_status' => 'publish',
			'post_type' => 'enquiry',
			);

			// Insert the post into the database.
			$post_id = wp_insert_post( $new_post );

			if( !$post_id ){
				return false;
			}

			if( ! is_wp_error( $post_id ) ) :

				/**
				 * @action_hook wte_after_enquiry_created
				 * 
				 * @since 2.2.0
				 */
				do_action( 'wte_after_enquiry_created', $post_id );

			endif;

			$arr['enquiry'] = array(
					'name' 	  => $name,
					'country' => $country,
					'email'	  => $email,
					'pname'	  => $_POST['enquiry_pid'],
					'contact' => $contact,
					'adults'  => $adult,
					'children'=> $children,
					'message' => $message1
			);
			add_post_meta( $post_id, 'wp_travel_engine_setting', $arr );

			$title = $name;

			$post_data = array(
				'ID'           => $post_id,
				'post_title'   => $title
			);

			// Update the post into the database.
			wp_update_post( $post_data );


			$result['type'] = "success";
			$result['message'] = __( "Your query has been successfully sent. Thank You.", 'wp-travel-engine' );		
		
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			{
				$result = json_encode($result);
				echo $result;
			}			
		}

		if( $admin_sent == 0 )
	    {	
			$result['type'] = "failed";
			$result['message'] = __( "Sorry, your query could not be sent at the moment. May be try again later. Thank You.","wp-travel-engine" );		
		
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			{
				$result = json_encode($result);
				echo $result;
			}
		}
		if( isset($_POST['query_confirmation']) && $_POST['query_confirmation']!= 'on' ) {
			$result['type'] = "failed";
			$result['message'] = __( "Confirmation failed, please try again. Thank You.","wp-travel-engine" );		
		}
		exit;	
	}
}
$obj = new WP_Travel_Engine_Enquiry_Form_Shortcodes;
$obj->init();