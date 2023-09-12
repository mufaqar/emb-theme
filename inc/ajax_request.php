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


add_action('wp_ajax_add_location', 'add_location', 0);
add_action('wp_ajax_nopriv_add_location', 'add_location');

function add_location() {
		global $wpdb;			
		$term_name = sanitize_text_field($_POST['name']);
        $taxonomy = 'location'; 
        $term_id = wp_insert_term($term_name, $taxonomy);
        if (!is_wp_error($term_id)) {
            echo 'success';
        } else {
            echo 'error';
        }
		
}

add_action('wp_ajax_add_branch', 'add_branch', 0);
add_action('wp_ajax_nopriv_add_branch', 'add_branch');

function add_branch() {
		global $wpdb;			
		$address = $_POST['address'];
		$company = $_POST['company'];
		$branch_code = $_POST['location_id'];
		$country = $_POST['country'];
		$name = sanitize_text_field($_POST['name']);

		$new_post = array(
			'post_title'    => $name,
			'post_content'  => $name,
			'post_status'   => 'publish',  
			'post_author'   => $company,     
			'post_type'     => 'branch'
		);

		$new_post_id = wp_insert_post($new_post);

		if ($new_post_id) {
			add_post_meta($new_post_id, 'branch_address', $address, true);
			add_post_meta($new_post_id, 'branch_company', $company, true);
			add_post_meta($new_post_id, 'branch_code', $branch_code, true);
			add_post_meta($new_post_id, 'branch_country', $country, true);
		}

		die();

		
}

add_action('wp_ajax_add_terminal', 'add_terminal', 0);
add_action('wp_ajax_nopriv_add_terminal', 'add_terminal');

function add_terminal() {
	global $wpdb;			
	$devnum = $_POST['devnum'];
	$devname = $_POST['devname'];
	$company = $_POST['company'];	
	$branch_name = $_POST['branch_name'];
	$floor_section = $_POST['floor_section'];


	

	$new_post = array(
		'post_title'    => $devnum,
		'post_content'  => $devname,
		'post_status'   => 'publish',  
		'post_author'   => $company,     
		'post_type'     => 'terminals'
	);

	$new_post_id = wp_insert_post($new_post);

	if ($new_post_id) {
		add_post_meta($new_post_id, 'terminal_devnum', $devnum, true);
		add_post_meta($new_post_id, 'terminal_devname', $devname, true);
		add_post_meta($new_post_id, 'terminal_company', $company, true);
		add_post_meta($new_post_id, 'terminal_branch_name', $branch_name, true);
		add_post_meta($new_post_id, 'terminal_floor_section', $floor_section, true);
	}

	die();

	
}




add_action('wp_ajax_switch_on', 'switch_on', 0);
add_action('wp_ajax_nopriv_switch_on', 'switch_on');

function switch_on() {

	$devnum = $_POST['id'];

	$token = get_option('system_token');
	$expiration_timestamp = get_option('system_token_expiration');
	if (!$token || !$expiration_timestamp || $expiration_timestamp < time()) {
		Generate_Token();
		return;
	}


	$meterNumber = $devnum; 
	$url = 'https://saven.jcen.cn/pwsys/sav/switchOn';

	$headers = array(
		'X-Access-Token' => $token,
		'Content-Type' => 'application/json',
	);

	$body = json_encode(array(
		'list' => array(
			array('meternum' => $meterNumber)
		)
	));

	$args = array(
		'headers' => $headers,
		'body' => $body,
		'method' => 'POST',
	);

	$response = wp_remote_request($url, $args);

	print_r($response);
		
		
}


add_action('wp_ajax_switch_off', 'switch_off', 0);
add_action('wp_ajax_nopriv_switch_off', 'switch_off');

function switch_off() {

	$devnum = $_POST['id'];
	$meterNumber = 	$devnum; // Replace this with your actual meter number
	$url = 'https://saven.jcen.cn/pwsys/sav/switchOff';

	$headers = array(
		'X-Access-Token' => $token,
		'Content-Type' => 'application/json',
	);

	$body = json_encode(array(
		'list' => array(
			array('meternum' => $meterNumber)
		)
	));

	$args = array(
		'headers' => $headers,
		'body' => $body,
		'method' => 'POST',
	);

	$response = wp_remote_request($url, $args);

	print_r($response);
		
		
}



