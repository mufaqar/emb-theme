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

add_action('wp_ajax_update_company', 'update_company', 0);
add_action('wp_ajax_nopriv_update_company', 'update_company');

function update_company() {
		global $wpdb;	
		$uid = $_POST['uid'];
		$company_username = $_POST['email'];
		$company_email = $_POST['email'];
		$company_name = $_POST['name'];
		$company_address = $_POST['address'];	
		$company_city = $_POST['city'];  
		$company_country = $_POST['country'];  	
		$user_data = array(
			'ID' => $uid,
			'user_login' => $company_email,
			'user_email' => $company_email,
			'display_name' => $company_name,
			'role' => 'company'
		);	
	  $user_id = wp_update_user($user_data);	
	  if (!is_wp_error($user_id)) {	
		update_user_meta( $user_id,'name', $company_name);	 
		update_user_meta( $user_id,'company_address', $company_address);	  
		update_user_meta( $user_id,'company_city', $company_city);
		update_user_meta( $user_id,'company_country', $company_country);			
		echo wp_send_json( array('code' => 200 , 'message'=>__('We have Created an account for you.')));  	
		
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


add_action('wp_ajax_update_location', 'update_location', 0);
add_action('wp_ajax_nopriv_update_location', 'update_location');

function update_location() {
		global $wpdb;			
		$term_name = sanitize_text_field($_POST['name']);
		$term_id = $_POST['tid'];
        $taxonomy = 'location'; 

		$args = array(
			'name' => $term_name, 
		);
	
    
		$result = wp_update_term( $term_id, $taxonomy, $args );
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
			update_post_meta($new_post_id, 'branch_address', $address, false);
			update_post_meta($new_post_id, 'branch_company', $company, false);
			update_post_meta($new_post_id, 'branch_code', $branch_code, false);
			update_post_meta($new_post_id, 'branch_country', $country, false);
		}

		die();

		
}


add_action('wp_ajax_update_branch', 'update_branch', 0);
add_action('wp_ajax_nopriv_update_branch', 'update_branch');

function update_branch() {
		global $wpdb;
		$pid = $_POST['pid'];			
		$address = $_POST['address'];
		$company = $_POST['company'];
		$branch_code = $_POST['location_id'];
		$country = $_POST['country'];
		$name = sanitize_text_field($_POST['name']);
		$locations = $_POST['floor_section'];
		$location_ids = explode(',', $locations);
		$new_post = array(
			'ID'           => $pid,
			'post_title'    => $name,
			'post_content'  => $name,
			'post_status'   => 'publish',  
			'post_author'   => $company,     
			'post_type'     => 'branch',
			'tax_input'    => array(
				'location' => $location_ids
			),		
			
		);

		$result = wp_update_post($new_post);		
		update_post_meta($pid, 'branch_address', $address, false);
		update_post_meta($pid, 'branch_company', $company, false);
		update_post_meta($pid, 'branch_code', $branch_code, false);
		update_post_meta($pid, 'branch_country', $country, false);
		//$new = wp_set_object_terms( $pid, array($location_ids), 'location' );

		

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


add_action('wp_ajax_update_terminal', 'update_terminal', 0);
add_action('wp_ajax_nopriv_update_terminal', 'update_terminal');

function update_terminal() {
	global $wpdb;	
		
	$pid = $_POST['pid'];	
	$devnum = $_POST['devnum'];
	$devname = $_POST['devname'];
	$company = $_POST['company'];	
	$branch_name = $_POST['branch_name'];
	$floor_section = $_POST['floor_section'];
	$new_post = array(
		'ID'           => $pid,
		'post_title'    => $devnum,
		'post_content'  => $devname,
		'post_status'   => 'publish',  
		'post_author'   => $company,     
		'post_type'     => 'terminals'
	);

	$new_post_id = wp_update_post($new_post);
	if ($new_post_id) {
		update_post_meta($new_post_id, 'terminal_devnum', $devnum, false);
		update_post_meta($new_post_id, 'terminal_devname', $devname, false);
		update_post_meta($new_post_id, 'terminal_company', $company, false);
		update_post_meta($new_post_id, 'terminal_branch_name', $branch_name, false);
		update_post_meta($new_post_id, 'terminal_floor_section', $floor_section, false);
	
	}

	die();

	
}




add_action('wp_ajax_switch_on', 'switch_on', 0);
add_action('wp_ajax_nopriv_switch_on', 'switch_on');

function switch_on() {

	$devnum = $_POST['id'];
	$pid = $_POST['pid'];

	

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
		'timeout' => 180 
	);

	$response = wp_remote_request($url, $args);

	// Check if the request was successful
	if (is_wp_error($response)) {
		echo "Error: " . $response->get_error_message();
	} else {
		// Get the response body as a JSON string
		$body = wp_remote_retrieve_body($response);

		// Decode the JSON string into an associative array
		$data = json_decode($body, true);

		if ($data && isset($data['success']) && $data['success'] === true) {
			update_post_meta( $pid, 'dev_status', 'On' );
		} else {
			echo "Error";
		}
	}
	die();

		
		
}


add_action('wp_ajax_switch_off', 'switch_off', 0);
add_action('wp_ajax_nopriv_switch_off', 'switch_off');

function switch_off() {

	$devnum = $_POST['id'];
	$pid = $_POST['pid'];
	echo $pid;
	$meterNumber = 	$devnum; 
	$url = 'https://saven.jcen.cn/pwsys/sav/switchOff';

	$token = get_option('system_token');
	$expiration_timestamp = get_option('system_token_expiration');
	if (!$token || !$expiration_timestamp || $expiration_timestamp < time()) {
		Generate_Token();
		return;
	}


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
		'timeout' => 180 
	);

	$response = wp_remote_request($url, $args);

	// Check if the request was successful
	if (is_wp_error($response)) {
		echo "Error: " . $response->get_error_message();
	} else {
		// Get the response body as a JSON string
		$body = wp_remote_retrieve_body($response);

		// Decode the JSON string into an associative array
		$data = json_decode($body, true);

		if ($data && isset($data['success']) && $data['success'] === true) {
			update_post_meta( $pid, 'dev_status', 'OFF' );
			
		} else {
			echo "Error";
		}
	}
		
		
}


add_action('wp_ajax_show_reports', 'show_reports', 0);
add_action('wp_ajax_nopriv_show_reports', 'show_reports');

function show_reports() {
		global $wpdb;	
		$branch = $_POST['branch'];
		$devname = $_POST['devname'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$type =  $_POST['type'];

	
		
		$post_terms = wp_get_post_terms($branch, 'location');
		$branchesarr = [];
		foreach ($post_terms as $term) {
			$term_id = $term->term_id;
			$term_name = $term->name;
			$term_slug = $term->slug;
			$branchesarr[$term_id] = $term_name;

		}
		$meta_query_branch = array(
			'relation' => 'OR',
		);

		foreach ($branchesarr as $section) {	
			$meta_query_branch[] = array(
				'key' => 'terminal_floor_section',
				'value' => $section,
				'compare' => '=',
			);
		}
		//print_r($meta_query_branch);
		$terminal_args = array(
			'post_type' => 'terminals', // Replace with your custom post type name
			'posts_per_page' => -1, // Retrieve all matching posts
			'meta_query' => $meta_query_branch,
		);

		//print "<pre>";
		//print_r($args);
		
		$custom_query = new WP_Query($terminal_args);
		$terminals_arr = [];
		if ($custom_query->have_posts()) {
			while ($custom_query->have_posts()) {
				$custom_query->the_post();
				$terminals_arr[Get_the_ID()] = get_the_title();
				
			}
			wp_reset_postdata(); // Reset the post data
		} else {
			// No posts found
		}

		
		




		if (isset($_POST['start_date']) && !empty($_POST['start_date'])) {
			$start_date = $_POST['start_date'];
		} else {
			$start_date = date('Y-m-01'); 
		}
		
		if (isset($_POST['end_date']) && !empty($_POST['end_date'])) {
			$end_date = $_POST['end_date'];
		} else {
			$end_date = date('Y-m-d'); 
		}
		
		?>
			<table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
				<thead>
					<tr>
						<th>Sr #</th>
						<th>Floor Station</th>	
						<th>Starting Date</th>
						<th>Ending date</th>
						<th>Total consumption</th>
						

					</tr>
				</thead>
				<tbody>
					<?php 	

					print "<pre>";

					if($branch == '' && $devname != '' ) 
					{	
						// By Floor	
					
						$meta_query = array(
							'relation' => 'AND',
						);						
						if (!empty($devname)) {
							$meta_query[] = array(
								'key' => 'devname',
								'value' => $devname,
								'compare' => '=',
							);
						}
				}

				else if($branch != '' &&  $devname == ''  ) {

					// By Branch	

					
					$meta_query = array(
						'relation' => 'OR',
					);			
					foreach ($terminals_arr as $terminal) {						
						$meta_query[] = array(
							'key' => 'devnum',
							'value' => $terminal,
							'compare' => '=',
						);
						$meta_query = array(
							'relation' => 'AND',
						);
					}
					


				}

				else if($branch != '' &&  $devname != ''  ) {
					// By Floor
					
					$meta_query[] = array(
						'key' => 'devname',
						'value' => $devname,
						'compare' => '=',
					);
					


				}
				

			

				//print_r($meta_query);
					
				
					if (!empty($start_date) && !empty($end_date)) {						
						$meta_query[] = array(
							'key' => 'operdate',
							'value' => array($start_date, $end_date),
							'compare' => 'BETWEEN',
							'type' => 'DATE', 
						);
					}		
				
						
					$query = new WP_Query(array(
						'post_type' => 'records',
						'posts_per_page' => -1,
						'meta_query' => $meta_query,
					));

				//	print_r($meta_query);




					if ($query->have_posts()) :
						$device_sums = array(); 					
						while ($query->have_posts()) : $query->the_post();
							$devname = get_post_meta(get_the_ID(), 'devname', true); 
							if (!empty($devname)) {         
								if (!isset($device_sums[$devname])) {
									$device_sums[$devname] = 0; 								}
								$device_sums[$devname] += (float) get_post_meta(get_the_ID(), 'qty_total', true);
							}
						endwhile;
						// Sort the device sums in descending order
						arsort($device_sums);
					
						$i = 1; // Counter for the rows
					
						foreach ($device_sums as $devname => $sum) :						

							$args = array(
								'post_type' => 'terminals',
								'meta_key' => 'terminal_devname',
								'meta_value' => $devname,
								'posts_per_page' => 1,
							);

							$posts = get_posts($args);
						

							$floor = get_post_meta($posts[0]->ID, 'terminal_floor_section', true);



					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $floor; ?></td>
								<td><?php echo $start_date ?></td>
								<td><?php echo $end_date ?></td>
							
								<td><?php echo $sum; ?> KWh</td>
							</tr>
					<?php
							$i++;
						endforeach;
					
						wp_reset_postdata();
					else :
					?>
						<tr>
							<td colspan="6"><?php _e('Nothing Found', 'lbt_translate'); ?></td>
						</tr>
					<?php
					endif;
					?>
					
							</div>

				</tbody>
			</table>
		<?php

		die();	
		
}