<?php

	
add_action('wp_ajax_add_company', 'add_company', 0);
add_action('wp_ajax_nopriv_add_company', 'add_company');

function add_company() {
		global $wpdb;	
		$company_username = $_POST['email'];
		$company_email = $_POST['email'];
		$company_name = $_POST['name'];
		$company_address = $_POST['address'];	
		$company_city = $_POST['city'];  
		$company_country = $_POST['country'];  	
		$user_data = array(
			'user_login' => $company_email,
			'user_email' => $company_email,
			'user_pass' => "123456789",	
			'display_name' => $company_name,
			'role' => 'company'
		);	
	  $user_id = wp_insert_user($user_data);	
	  if (!is_wp_error($user_id)) {	
		update_user_meta( $user_id,'name', $company_name);	 
		update_user_meta( $user_id,'company_address', $company_address);	  
		update_user_meta( $user_id,'company_city', $company_city);
		update_user_meta( $user_id,'company_country', $company_country);			
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

