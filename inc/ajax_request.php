<?php



add_action('wp_ajax_add_ticket', 'add_ticket', 0);
add_action('wp_ajax_nopriv_add_ticket', 'add_ticket');

function add_ticket()
{
	global $wpdb;
	$title = $_POST['title'];
	$date = $_POST['date'];
	$address = $_POST['address'];
	$ticket_type = $_POST['ticket_type'];
	$ticket_priority = $_POST['ticket_priority'];
	$ticket_status = $_POST['ticket_status'];
	$ticket_cat = $_POST['ticket_cat'];
	$issues = $_POST['issues'];
	$shipping = $_POST['shipping'];
	$user_type = $_POST['user_type'];
	$uid = $_POST['uid'];
	$file_name = $_FILES["file"]["name"];
	$file_url        = $_FILES["file"]["tmp_name"]; 
	$post = array(
		'post_title'    => $title,
		'post_status'   => 'publish',
		'post_content'   => $issues,
		'post_type'     => 'tickets',
		'meta_input'   => array(
			'title' => $title,
			'address' => $address,
			'shipping' => $shipping,
			'issues' => $issues,
			'date' => $date,
			'user_type' => $user_type,
			'order_uid' => $uid,
		),
		'tax_input'    => array(
			'ticket_type' => array($ticket_type),
			'ticket_priority' => array($ticket_priority),
			'ticket_status' => array($ticket_status),
			'ticket_cat' => array($ticket_cat)
		),

	);
		$inserted_post_id = wp_insert_post($post);
		$user = get_user_by( 'id', $uid );
		$agent_email = $user->user_email;
		sendmail($agent_email,"New Ticket Created by $agent_email ", $inserted_post_id);

	    $image_url        = $file_url; // Define the image URL here
		$image_name       = $file_name;
		$upload_dir       = wp_upload_dir(); // Set upload folder
		$image_data       = file_get_contents($image_url); // Get image data
		$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
		$filename         = basename( $unique_file_name ); // Create image file name
		if( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		file_put_contents( $file, $image_data );
		$wp_filetype = wp_check_filetype( $filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);



	if (!is_wp_error($inserted_post_id)) {	

		// Create the attachment
		$attach_id = wp_insert_attachment( $attachment, $file, $inserted_post_id );
		 require_once(ABSPATH . 'wp-admin/includes/image.php');
		 $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		set_post_thumbnail( $inserted_post_id, $attach_id );
		echo wp_send_json(array('code' => 200, 'message' => __('Ticket Created Sucessfully')));
		die();
	} else {
		echo wp_send_json(array('code' => 0, 'message' => __('Error Occured please fill up form carefully.')));
		die();
	}

	die;
}


add_action('wp_ajax_update_ticket', 'update_ticket', 0);
add_action('wp_ajax_nopriv_update_ticket', 'update_ticket');

function update_ticket()
{


	global $wpdb;
	$pid = $_POST['pid'];
	$title = $_POST['title'];
	$date = $_POST['date'];
	$address = $_POST['address'];
	$ticket_type = $_POST['ticket_type'];
	$ticket_priority = $_POST['ticket_priority'];
	$ticket_status = $_POST['ticket_status'];
	$ticket_cat = $_POST['ticket_cat'];
	$issues = $_POST['issues'];
	$shipping = $_POST['shipping'];
	$user_type = $_POST['user_type'];
	$uid = $_POST['uid'];
	$post = array(
		'ID' => $pid,
		'post_title'    => $title,
		'post_status'   => 'publish',
		'post_content'   => $issues,
		'post_type'     => 'tickets',
		'meta_input'   => array(
			'title' => $title,
			'address' => $address,
			'shipping' => $shipping,
			'issues' => $issues,
			'date' => $date,
			'user_type' => $user_type
		
		),
		'tax_input'    => array(
			'ticket_type' => array($ticket_type),
			'ticket_priority' => array($ticket_priority),
			'ticket_status' => array($ticket_status),
			'ticket_cat' => array($ticket_cat),
			
		),

	);
		$update_post = wp_update_post($post);
		$user = get_user_by( 'id', $uid );
		$agent_email = $user->user_email;
		sendmail($agent_email,"Ticket Updated by $agent_email ", $pid);
		

	if (!is_wp_error($update_post)) {
	
		echo wp_send_json(array('code' => 200, 'message' => __('Ticket Updated Sucessfully')));
		die();
	} else {
		echo wp_send_json(array('code' => 0, 'message' => __('Error Occured please fill up form carefully.')));
		die();
	}

	die;
}




add_action('wp_ajax_tech_update_ticket', 'tech_update_ticket', 0);
add_action('wp_ajax_nopriv_tech_update_ticket', 'tech_update_ticket');

function tech_update_ticket()
{


	global $wpdb;
	$pid = $_POST['pid'];	
	$title = $_POST['title'];
	$date = $_POST['date'];
	$address = $_POST['address'];
	$ticket_type = $_POST['ticket_type'];
	$ticket_priority = $_POST['ticket_priority'];
	$ticket_status = $_POST['ticket_status'];
	$ticket_cat = $_POST['ticket_cat'];
	$eng_remarks = $_POST['eng_remarks'];
	$internal_remarks = $_POST['internal_remarks'];
	$user_type = $_POST['user_type'];
	$pid = $_POST['pid'];
	$invoice = $_POST['invoice'];
	$price = $_POST['price'];
	$tech_uid = $_POST['uid'];	
	$file_name = $_FILES["file"]["name"];
	$file_url        = $_FILES["file"]["tmp_name"]; 

	$post = array(
		'ID' => $pid,
		'post_title'    => $title,
		'post_status'   => 'publish',
		'post_content'   => $issues,
		'post_type'     => 'tickets',
		'meta_input'   => array(
			'title' => $title,
			'address' => $address,
			'eng_remarks' => $eng_remarks,
			'internal_remarks' => $internal_remarks,
			'invoice' => $invoice,	
			'price' => $price,			
			'date' => $date	
		),
		'tax_input'    => array(
			'ticket_type' => array($ticket_type),
			'ticket_priority' => array($ticket_priority),
			'ticket_status' => array($ticket_status),
			'ticket_cat' => array($ticket_cat)
		),

	);
	wp_update_post($post);

		$update_post = wp_update_post($post);
		$user_tech = get_user_by( 'id', $tech_uid );
		$tech_email = $user_tech->user_email;
		$ticket_uid = get_post_meta( $pid, 'order_uid', true);
		$user_agent =  get_user_by( 'id', $ticket_uid);
		$agent_email = $user_agent->user_email;
		sendmail($agent_email,"Technician [ $tech_email ] Updated Ticket  $pid ", $pid);

		$ticket_id = $pid;
		$image_url        = $file_url;
		$image_name       = $file_name;
		$upload_dir       = wp_upload_dir(); 
		$image_data       = file_get_contents($image_url); 
		$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); 
		$filename         = basename( $unique_file_name ); 
		if( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		file_put_contents( $file, $image_data );
		$wp_filetype = wp_check_filetype( $filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);


		$attach_id = wp_insert_attachment( $attachment, $file, $ticket_id );
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		//sendmail($username,$password);		
			$query_meta = array(
				'posts_per_page' => -1,
				'post_type' => 'orders',
				'meta_query' => array(
					array(
						'key'     => 'order_id',
						'value' =>   $ticket_id,
						'compare' => '=='
					)
				)
			);		

		   $postinweek = new WP_Query($query_meta);
		if ( $postinweek->have_posts() ): while ( $postinweek->have_posts() ): $postinweek->the_post();	
			
				// Updated order if exist
				if( has_term('complete', 'ticket_type' , $ticket_id) ){	
				$updated_post_id = get_the_ID();
				update_post_meta($updated_post_id, 'order_price', $price);
				update_post_meta($updated_post_id, 'order_status','Pending');			
				echo wp_send_json(array('code' => 200, 'message' => __('Ticket Update with Invoice')));
				}
				die;
		endwhile; wp_reset_query(); else : 	
			// Insert post as its not exisit 
			
			$order_uid =   get_post_meta( $ticket_id, 'order_uid', true );
			$order_arg = array(	
				'post_title'    => "OHYSX-" . $ticket_id,
				'post_status'   => 'publish',
				'post_type'     => 'orders',
				'meta_input'   => array(
					'date' => $date,
					'order_id' => $ticket_id,
					'order_price' => $price,
					'invoice_uid' => $order_uid
				)
			);
			if( has_term('complete', 'ticket_type' , $ticket_id) ){
				$inovice_id = wp_insert_post($order_arg);	
				echo wp_send_json(array('code' => 0, 'message' => __('Tecket updated and Invoice created.')));	
				echo "Yes Term Inovice";
			}
			
		
			die;

		endif; 



		

	

	die;
}



add_action('wp_ajax_super_update_ticket', 'super_update_ticket', 0);
add_action('wp_ajax_nopriv_super_update_ticket', 'super_update_ticket');

function super_update_ticket()
{


	global $wpdb;
	$pid = $_POST['pid'];	
	$title = $_POST['title'];
	$date = $_POST['date'];
	$address = $_POST['address'];
	$ticket_type = $_POST['ticket_type'];
	$ticket_priority = $_POST['ticket_priority'];
	$ticket_status = $_POST['ticket_status'];
	$ticket_cat = $_POST['ticket_cat'];
	$eng_remarks = $_POST['eng_remarks'];
	$internal_remarks = $_POST['internal_remarks'];
	$user_type = $_POST['user_type'];
	$pid = $_POST['pid'];
	$invoice = $_POST['invoice'];
	$price = $_POST['price'];
	$tech_uid = $_POST['uid'];	
	$file_name = $_FILES["file"]["name"];
	$file_url        = $_FILES["file"]["tmp_name"]; 

	$post = array(
		'ID' => $pid,
		'post_title'    => $title,
		'post_status'   => 'publish',
		'post_content'   => $issues,
		'post_type'     => 'tickets',
		'meta_input'   => array(
			'title' => $title,
			'address' => $address,
			'eng_remarks' => $eng_remarks,
			'internal_remarks' => $internal_remarks,
			'invoice' => $invoice,	
			'price' => $price,			
			'date' => $date	
		),
		'tax_input'    => array(
			'ticket_type' => array($ticket_type),
			'ticket_priority' => array($ticket_priority),
			'ticket_status' => array($ticket_status),
			'ticket_cat' => array($ticket_cat)
		),

	);
		wp_update_post($post);

		$update_post = wp_update_post($post);
		$user = get_user_by( 'id', $tech_uid );
		$admin_email = $user->user_email;
		$ticket_uid = get_post_meta( $pid, 'order_uid', true);
		$user_agent =  get_user_by( 'id', $ticket_uid);
		$agent_email = $user_agent->user_email;
		sendmail($agent_email,"Administrator [ $admin_email ] Updated Ticket  $pid ", $pid);




	$ticket_id = $pid;

		$image_url        = $file_url;
		$image_name       = $file_name;
		$upload_dir       = wp_upload_dir(); 
		$image_data       = file_get_contents($image_url); 
		$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); 
		$filename         = basename( $unique_file_name ); 
		if( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		file_put_contents( $file, $image_data );
		$wp_filetype = wp_check_filetype( $filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);


		$attach_id = wp_insert_attachment( $attachment, $file, $ticket_id );
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		//sendmail($username,$password);		
			$query_meta = array(
				'posts_per_page' => -1,
				'post_type' => 'orders',
				'meta_query' => array(
					array(
						'key'     => 'order_id',
						'value' =>   $ticket_id,
						'compare' => '=='
					)
				)
			);		

		   $postinweek = new WP_Query($query_meta);
		if ( $postinweek->have_posts() ): while ( $postinweek->have_posts() ): $postinweek->the_post();	
			
				// Updated order if exist
				if( has_term('complete', 'ticket_type' , $ticket_id) ){	
				$updated_post_id = get_the_ID();
				update_post_meta($updated_post_id, 'order_price', $price);
				update_post_meta($updated_post_id, 'order_status','Pending');			
				echo wp_send_json(array('code' => 200, 'message' => __('Ticket Update with Invoice')));
				}
				die;
		endwhile; wp_reset_query(); else : 	
			// Insert post as its not exisit 
			
			$order_uid =   get_post_meta( $ticket_id, 'order_uid', true );
			$order_arg = array(	
				'post_title'    => "OHYSX-" . $ticket_id,
				'post_status'   => 'publish',
				'post_type'     => 'orders',
				'meta_input'   => array(
					'date' => $date,
					'order_id' => $ticket_id,
					'order_price' => $price,
					'invoice_uid' => $order_uid
				)
			);
			if( has_term('complete', 'ticket_type' , $ticket_id) ){
				$inovice_id = wp_insert_post($order_arg);	
				echo wp_send_json(array('code' => 0, 'message' => __('Tecket updated and Invoice created.')));	
				echo "Yes Term Inovice";
			}
			
		
			die;

		endif; 



		

	

	die;
}





add_action('wp_ajax_admin_update_invoice', 'admin_update_invoice', 0);
add_action('wp_ajax_nopriv_admin_update_invoice', 'admin_update_invoice');

function admin_update_invoice()
{

	global $wpdb;
	$pid = $_POST['pid'];	
	$order_status = $_POST['order_status'];
	$order_price_paid = $_POST['order_price_paid'];
	$admin_remarks = $_POST['admin_remarks'];
	$price = $_POST['price'];
	update_post_meta($pid, 'order_price_paid', $order_price_paid);
	update_post_meta($pid, 'admin_remarks', $admin_remarks);
	wp_set_object_terms( $pid, $terms, $taxonomy, $append ); 
	wp_set_post_terms( $pid, array( $order_status ), 'order_status' ); 
	echo wp_send_json(array('code' => 0, 'message' => __('Invoice Sucessfully Updated.')));
	die;


}



add_action('wp_ajax_get_invoice_detail', 'get_invoice_detail', 0);
add_action('wp_ajax_nopriv_get_invoice_detail', 'get_invoice_detail');

	function get_invoice_detail()
	{
							global $wpdb;	
							$orderid = $_POST['orderid'];		
						
						
							$args = array('p' => $orderid, 'post_type' => 'orders');
							
							$uid =  get_post_meta( $orderid, 'invoice_uid', true );
							$user_info = get_userdata( $uid);
							

						 
						   $order_price =  get_post_meta( $orderid, 'order_price', true );
						   $order_price_gst =  $order_price * 15 / 100; 						   
						   $order_total  =   $order_price-$order_price_gst;		
						   $ticket_id =  get_post_meta( $orderid, 'order_id', true );	   

						  

							
							?>

				
						            
						   <div class="invoice_table">
						   <img src="<?php bloginfo('template_directory'); ?>/reources/images/logo.png" style="max-width:150px">							
							<p>1191 Eruera Street, Rotorua 3010, Bay of Plenty, New Zealand</p>
							<p>Mobile 02102838349, Phone 0064-7-3477044 <br> Email: info@smartphonesrepair.co.nz  </p>
							<h6>Bank ASB #: 12-3155-0266675-00</h6>
							<h6>GST #: 115-122-770</h6>
								<table class="invoice_slip_table">
									<thead>
									<tr>
										<th scope="col">Name</th>
										<th scope="col">Details</th>
									</tr>
									</thead>							
									<tbody>
									<tr>
										<td scope="row"><strong>Invoice Id: </strong></td>
										<td scope="row"><?php echo get_the_title($orderid);?></td>
										
									</tr>
									<tr>
										<td scope="row"><strong>Created Date</strong></td>
										<td scope="row"><?php echo  get_post_meta( $orderid, 'date', true ); ;?></td>
										
									</tr>
									<tr>
										<td scope="row"><strong>Created By: </strong></td>
										<td scope="row"><?php echo $user_info->user_login ?></td>
									</tr>
									<tr>
										<td scope="row"><strong>Price: </strong></td>
										<td scope="row"><strong>$ </strong><?php echo $order_total?></td>
									</tr>
									<tr>
										<td scope="row"><strong>GST</strong></td>
										<td scope="row">( 15% = <?php echo $order_price_gst?>) </td>
									</tr>
									<tr>
										<td scope="row"><strong>Total </strong></td>
										<td scope="row"><strong>$ </strong> <?php echo $order_price?> </td>
									</tr>
									
									</tbody>
								</table>
							
								<h5 class="mt-4">Ticket Summary</h5>
								<table class="invoice_slip_table">
									<thead>
									<th scope="col">Name</th>
									<th scope="col">Details</th>
								
									</thead>
									<tbody>

									<tr>
										<td scope="row"><strong>Ticket Id </strong></td>
										<td scope="row"><?php echo get_the_title($ticket_id); ?></td>
										
									</tr>									
									
									<tr>
										<td scope="row"><strong>Agent Remarks: </strong></td>
										<td scope="row"><?php echo get_post_meta( $ticket_id, 'issues', true ); ?></td>
										
									</tr>
									<tr>
										<td scope="row"><strong>Technician Remarks </strong></td>
										<td scope="row"><?php echo get_post_meta( $ticket_id, 'eng_remarks', true ); ?></td>
										
									</tr>
									<tr>
										<td scope="row"><strong>Address </strong></td>
										<td scope="row"><?php echo get_post_meta( $ticket_id, 'address', true ); ?></td>
										
									</tr>
									<tr>
										<td scope="row"><strong>Shipping Details </strong></td>
										<td scope="row"><?php echo get_post_meta( $ticket_id, 'shipping', true ); ?></td>
										
									</tr>

									<tr>
								
										<td colspan="2" scope="row">
										<strong>Terms and Conditions </strong>										
										<ul>
											<li>1: Diagnosed fees will apply for all repairs even if the gadget is not repairable or job cancelled by customer.</li>
											<li></li>
											<li>2: Part order on customer behalf and deposit is 50% is taken the deposit is nonrefundable as we order part on customer behalf.</li>
											<li></li>
											<li>3: All the parts fitted come with 3 month warranty unless specified. We will fix the fault & check with which gadget is booked. No other functionality checked unless a thorough assessment is requested & assessment fee is paid and also provide the password or login id.</li>
											<li></li>
											<li>4: All repair come with 3 month warranty unless specified. LCD are fragile any external pressure while in pocket or any other place or harsh use will break without damaging the top glass as top glass is harder/ stronger then underneath LCD in such case warranty will be voided.</li>
											<li></li>
											<li>5: Any physical damage which includes liquid damage, dropped, and any pressure on the LCD which break the display will not be covered in warranty. Any gadget returned under warranty and it is find out to be physical damage diagnostic will apply. In any dispute customer is required to get third party opinion on their own cost from a reputable repair shop and provide a copy of the report.</li>
											<li></li>
											<li>6: Warranty is provided only on the part we have replaced not any other part of gadget.</li>
											<li></li>
											<li>7: No responsibility taken of any data loss while working on any gadget. Backup all your data before it is booked for a repair.</li>
											<li></li>
											<li>8: Customer ‘s responsibility to pick their gadget within 2 months’ time after it fixed and pay repairing fee in full. No gadget will be delivered if not aid In full or sell my gadget is not picked within 2 month time it will be disposed off or sold to recover the cost. I authorize budget computer to dispose off or sell my gadget to recover cost if not picked and paid within 2 month time.</li>
											<li></li>
											<li>9: Warranty repair cannot be checked straight away. We need reasonable time to check and fix.</li>
											<li></li>
											<li>10: Software/ operating system installation if virus infected or corrupted by customer negligence or misuse or any third party software not working no responsibility taken.</li>
											<li></li>
											<li>11: Customer advised to take their SD card/sim cards out from phone before they give for as budget computer takes no responsibility for any loss SD sim card/SD card etc.</li>
											<li></li>
											<li>If you damage or lose or do not return the loan equipment you will be charged for its repair or replacement. For more details of your terms & conditions please visit our website at www.smartphonesrepair.co.nz</li>
										</ul>
										</td>
										
									</tr>
										
									<tbody>
								</table>

								  
   
							
                      
                     

				 
						   
	

					<?php	die;
	}



	
add_action('wp_ajax_print_invoice', 'print_invoice', 0);
add_action('wp_ajax_nopriv_print_invoice', 'print_invoice');

	function print_invoice()
	{


		?>

			<div id='pdf'>
			<div class="popup_wrapper">
					<h3 class="ad_productss">Invoice</h3>

					<div class="invoice_table">
					<table class="_table">
						<thead>
						<tr>
							<th scope="col">Invoice Date</th>
							<th scope="col">Total</th>
							<th scope="col">Total</th>
							<th scope="col">Status</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td scope="row">Sunday, May 29, 2022</td>
							<td>80</td>
							<td>459.2</td>
							<td>Complete <i class="fa-solid fa-down-to-line"></i></td>
						</tr>
						<tr>
							<td scope="row">Sunday, June 5, 2022</td>
							<td>80</td>
							<td>459.2</td>
							<td>Pending <i class="fa-solid fa-down-to-line"></i></td>
						</tr>
						<tr>
							<td scope="row">Sunday, June 6, 2022</td>
							<td>80</td>
							<td>459.2</td>
							<td>Pending <i class="fa-solid fa-down-to-line"></i></td>
						</tr>
						</tbody>
					</table>
					</div>     
				</div>
			</div>

			


		<?php

		// ob_start();
		// require_once __DIR__ . '/vendor/autoload.php';

		// $mpdf = new \Mpdf\Mpdf();
		// $mpdf->WriteHTML('<h1>Hello world!</h1>');
		// $mpdf->Output();

		// echo "Hi";
		
							
		die;
	}



	
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



add_action('wp_ajax_resetpassword', 'resetpassword', 0);
add_action('wp_ajax_nopriv_resetpassword', 'resetpassword');
function resetpassword() {	
		
	  global $wpdb;  
 
      $username = $_POST['username'];
      $email = $_POST['username'];    
	  $password = generateRandomString();	
	  $user_data = array(
		'user_login' => $username,
		'user_email' => $username,
		'user_pass' => $password,	
		
		);

		$user = get_user_by( 'email', $email );
		$user_id = $user->ID;
	    $user_id = wp_update_user( array ( 'ID' => $user_id, 'user_pass' => $password ) );	
	  	if (!is_wp_error($user_id)) {		    
			send_reset_password($username,$password);
			echo wp_send_json( array('code' => 200 , 'message'=>__('Password Updated , Please check your email')));
	  	} else {	    		         
			  echo wp_send_json( array('code' => 0 , 'message'=>__('Error Occured please check your email address')));
	      	}
	  	
	die;   	
		
}



/// Add Repair


add_action('wp_ajax_super_get_child_cat', 'super_get_child_cat', 0);
add_action('wp_ajax_nopriv_super_get_child_cat', 'super_get_child_cat');

function super_get_child_cat()
{
	
	$parent_slug = $_POST['parent_id'];
	$term = get_term_by('slug', $parent_slug, 'model_type_cat');
	$parent_id = $term->term_id;

	//echo $parent_id;
    $subcategories = get_categories( array(
      'taxonomy' => 'model_type_cat',
      'parent' => $parent_id,
      'hide_empty' => false
    ) );
    $output = '<option value="">Select a Model</option>';
    foreach ( $subcategories as $subcategory ) {
      $output .= '<option value="'. $subcategory->term_id.'" data-id="'.$subcategory->slug.'">' . $subcategory->name . '</option>';
    }
    wp_send_json($output);
    wp_die();
}


add_action('wp_ajax_super_get_fault_cat', 'super_get_fault_cat', 0);
add_action('wp_ajax_nopriv_super_get_fault_cat', 'super_get_fault_cat');

function super_get_fault_cat()
{
	$parent_slug = $_POST['parent_id'];
	$term = get_term_by('slug', $parent_slug, 'cat_fault_type');
	$parent_id = $term->term_id;
    $subcategories = get_categories( array(
      'taxonomy' => 'cat_fault_type',
      'parent' => $parent_id,
      'hide_empty' => false
    ) );
    $output = '<option value="">Select Fault</option>';
    foreach ( $subcategories as $subcategory ) {
      $output .= '<option value="' . $subcategory->term_id . '">' . $subcategory->name . '</option>';
    }
    wp_send_json($output);
    wp_die();
}
//super_get_fault_cat

add_action('wp_ajax_super_get_model_cat', 'super_get_model_cat', 0);
add_action('wp_ajax_nopriv_super_get_model_cat', 'super_get_model_cat');

function super_get_model_cat()
{
	$parent_slug = $_POST['parent_id'];
	$term = get_term_by('slug', $parent_slug, 'model_cat');
	$parent_id = $term->term_id;
    $subcategories = get_categories( array(
      'taxonomy' => 'model_cat',
      'parent' => $parent_id,
      'hide_empty' => false
    ) );
    $output = '<option value="">Select Model</option>';
    foreach ( $subcategories as $subcategory ) {
      $output .= '<option value="' . $subcategory->term_id . '">' . $subcategory->name . '</option>';
    }
    wp_send_json($output);
    wp_die();
}





add_action('wp_ajax_add_repair', 'add_repair', 0);
add_action('wp_ajax_nopriv_add_repair', 'add_repair');

function add_repair()
{
	global $wpdb;
	$ticket_cat = $_POST['ticket_cat'];

	
	$model_type_cat = $_POST['model_cat'];
	$falt_cat = $_POST['falt_cat'];
	$model_nocat = $_POST['model_nocat'];
	$parts_availablity = $_POST['parts_availablity'];
	$repair_cost = $_POST['repair_cost'];
	$diagnostic_fee = $_POST['diagnostic_fee'];	

	// Model NO
	$term_model_nocat = get_term( $model_nocat, 'model_cat' );
	$model_no_cat_name = $term_model_nocat->name;

	// Fault Cat
	$term_falt_cat = get_term( $falt_cat, 'cat_fault_type' );
	$falt_cat_name = $term_falt_cat->name;

	//model type Cate
	$term_model_type_cat = get_term( $model_type_cat, 'model_type_cat' );	
	$model_type_name = $term_model_type_cat->name;
	// Type 
	$term_type_cat = get_term( $ticket_cat, 'repair_cat' );	
	$type_name = $term_type_cat->name;
	
	$title =  $type_name ." : ".$model_type_name." : " .$falt_cat_name." : ".$model_no_cat_name;
	$post = array(
		'post_title'    => $title ,
		'post_status'   => 'publish',
		'post_type'     => 'repair',
		'meta_input'   => array(
			'title' => $title ,
			'parts_availablity' => $parts_availablity,
			'repair_cost' => $repair_cost,
			'diagnostic_fee' => $diagnostic_fee,			
		),
		'tax_input'    => array(
			'repair_cat' => array($ticket_cat),
			'cat_fault_type' => array($falt_cat),
			'model_cat' => array($model_nocat),
			'model_type_cat' => array($model_type_cat)		
		),

	);	
	
	$inserted_post_id = wp_insert_post($post);
	if (!is_wp_error($inserted_post_id)) {	
		echo wp_send_json(array('code' => 200, 'message' => __('Repair Created Sucessfully')));
		die();
	} else {
		echo wp_send_json(array('code' => 0, 'message' => __('Error Occured please fill up form carefully.')));
		die();
	}

}


function autocomplete_search() {
	$query = $_POST['query'];
	$search_results = get_posts(array(
	   's' => $query,
	   'post_type' => 'repair',
	   'posts_per_page' => -1,
	   'orderby' => 'relevance',
	   'order' => 'DESC'
	));
	echo "<ul>";
	if($search_results) {
	   foreach($search_results as $result) {
		  echo '<li><a class="result" href="' . get_permalink($result->ID) . '">' . $result->post_title . '</a> <a class="btn_primary"  href="' . get_permalink($result->ID) . '">View Price </a></li>';
	   }
	} else {
	   echo 'No results found';
	}
	echo "</ul>";
	die();
 }
 add_action('wp_ajax_autocomplete_search', 'autocomplete_search');
 add_action('wp_ajax_nopriv_autocomplete_search', 'autocomplete_search');


 function get_repair_price() {
	$ticket_cat = $_POST['ticket_cat'];
	$falt_cat = $_POST['falt_cat'];
	$model_name = $_POST['model_name'];	
	$model_cat = $_POST['model_cat'];	
	// echo $ticket_cat . "-Ticket <br/>" ;
	// echo $model_cat . "-Model Cate <br/>" ;
	// echo $falt_cat . "-Fault <br/>" ;	
	// echo $model_name . "-Model  Name <br/>" ;
	$tax_query = array('relation' => 'AND');
    if (!empty($ticket_cat))
    {
        $tax_query[] =  array(
                'taxonomy' => 'repair_cat',
                'field' => 'term_id',
                'terms' => $ticket_cat
            );
    }
    if (!empty($falt_cat))
    {
        $tax_query[] =  array(
                'taxonomy' => 'cat_fault_type',
                'field' => 'id',
                'terms' => $falt_cat
            );
    }
  
    if (!empty($model_cat))
    {
        $tax_query[] =  array(
                'taxonomy' => 'model_type_cat',
                'field' => 'id',
                'terms' => $model_cat
            );
    }
	if (!empty($model_name))
    {
        $tax_query[] =  array(
                'taxonomy' => 'model_cat',
                'field' => 'id',
                'terms' => $model_name
            );
    }

	// print "<pre>";
	// print_r($tax_query);
  	$search_results = get_posts(array(
	  // 's' => $query,
	   'post_type' => 'repair',
	   'posts_per_page' => -1,
	   'orderby' => 'relevance',
	   'order' => 'DESC',
	   'tax_query' => $tax_query	   
	));
	echo "<ul>";

	//print_r($search_results);


	if($search_results) {
	   foreach($search_results as $result) {
		  echo '<li><a class="result" href="' . get_permalink($result->ID) . '">' . $result->post_title . '</a> <a class="btn_primary"  href="' . get_permalink($result->ID) . '">View Price </a></li>';
	   }
	} else {
	    ?>
		  	
			<h2 style="margin-left:30px" >Message or call for a quote </h2> <hr/><br/>
			

            <a style="margin-left:30px" class="btn_primary btn_sec"  href="tel:073477044">DID: 073477044 </a>

            <a style="margin-left:30px" class="btn_primary btn_sec"  href="mailto:budgetcomputer2013@gmail.com ">budgetcomputer2013@gmail.com </a>

		<?php
	}
	echo "</ul>";
	die();
 }
 add_action('wp_ajax_get_repair_price', 'get_repair_price');
 add_action('wp_ajax_nopriv_get_repair_price', 'get_repair_price');







