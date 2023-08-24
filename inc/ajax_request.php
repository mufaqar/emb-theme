<?php

	
add_action('wp_ajax_agent_create_signup', 'agent_create_signup', 0);
add_action('wp_ajax_nopriv_agent_create_signup', 'agent_create_signup');

function agent_create_signup() {
		global $wpdb;	
		$username = $_POST['agent_email'];
		$agent_email = $_POST['agent_email'];
		$agent_name = $_POST['agent_name'];
		$business_address = $_POST['business_address'];	
		$business_name = $_POST['business_name'];  
		$business_phone = $_POST['business_phone'];  
		$postal_code = $_POST['postal_code'];  	
		$user_data = array(
			'user_login' => $username,
			'user_email' => $agent_email,
			'user_pass' => $password,	
			'display_name' => $agent_name,
			'role' => 'agent'
		);	
	  $user_id = wp_insert_user($user_data);	
	  if (!is_wp_error($user_id)) {	
		update_user_meta( $user_id,'business_name', $business_name);	 
		update_user_meta( $user_id,'business_phone', $business_phone);	  
		update_user_meta( $user_id,'postal_code', $postal_code);
		$code = sha1( $user_id);		
		$activation_link = add_query_arg( array( 'key' => $code, 'user' => $user_id ), get_permalink(179));
		add_user_meta( $user_id, 'has_to_be_activated', $code, true );
		activation_mail($agent_email, $activation_link);			
		echo wp_send_json( array('code' => 200 , 'message'=>__('We have Created an account for you.')));
	  	
		
	  } else {
		if (isset($user_id->errors['empty_user_login'])) {	          
		  echo wp_send_json( array('code' => 0 , 'message'=>__('User Name and Email are mandatory')));
		  } elseif (isset($user_id->errors['existing_user_login'])) {
		  echo wp_send_json( array('code' => 0 , 'message'=>__('This email address is already registered.')));
		  } else {	         
		  echo wp_send_json( array('code' => 0 , 'message'=>__('Error Occured please fill up the sign up form carefully.')));
		  }
	  }
       
	die;   
		
}

