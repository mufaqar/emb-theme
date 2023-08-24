<?php

	// Agent  Ticket Update  Email 
	function sendmail($agent_email,$message,$postid) {		
		$subject = "Budget Computer & Kiwi Mobiles  |  $message ";
		$headers[] = 'From: budgetcomputer@kiwimobiles.co.nz" . "\r\n';
		$headers[] = 'Bcc: choudhry.asif@gmail.com';
		$headers[] = 'Bcc: budgetcomputer2013@gmail.co';
		$headers[] = 'Bcc: uziasif06@gmail.com';
		$headers[] = "Content-Type: text/html; charset=UTF-8\r\n";
		$body   = "<p><img src='https://kiwimobiles.co.nz/jobform/wp-content/themes/nzstore/reources//images/logo.png' width='320px'></img></p><hr/> ";
		$body  .= "<p><strong> $message  </strong> <br/> Ticket   :  ".get_permalink($postid)."  </p>";	
		wp_mail( $agent_email, $subject, $body, $headers );
		$get_notifcation = get_post_meta( $postid, 'notification', true); 
		$count = $get_notifcation;
		update_post_meta( $postid, 'notification', $count+1); 
		}


	// Agent Activation Email 

	function activation_mail($to,$activation_link) {
		$subject = 'Budget Computer & Kiwi Mobiles | User Account Activation';	
		$headers[] = 'From: budgetcomputer@kiwimobiles.co.nz" . "\r\n';
		$headers[] = "Content-Type: text/html; charset=UTF-8\r\n";
		$body   = "<p><img src='https://kiwimobiles.co.nz/jobform/wp-content/themes/nzstore/reources//images/logo.png' width='320px'></img></p><hr/> ";
		$body  .= "<p><strong> Account Activation Link: </strong><a href='$activation_link' >Activate your Account</a> </p> ";
		$body  .= "<p><strong> DID:   </strong> 09 9508717 </p> ";
		$body  .= "<p><strong> Email:   </strong>budgetcomputer@kiwimobiles.co.nz</p> ";
		wp_mail( $to, $subject, $body, $headers );
	}

		// Reset Password Email 

	function send_reset_password($username,$password) {
		$subject = 'Budget Computer & Kiwi Mobiles | User Account Activation';	
		$headers[] = 'From: budgetcomputer@kiwimobiles.co.nz" . "\r\n';
		$headers[] = "Content-Type: text/html; charset=UTF-8\r\n";
		$body   = "<p><img src='https://kiwimobiles.co.nz/jobform/wp-content/themes/nzstore/reources//images/logo.png' width='320px'></img></p><hr/> ";
		$body  .= "<p><strong> Username : </strong>$username </p> ";
		$body  .= "<p><strong> Password : </strong>$password </p> ";
		wp_mail( $to, $subject, $body, $headers );
	}


	// Send mail to Agent Email 
	function sendmail_agent($to,$password) {
		$subject = 'Budget Computer & Kiwi Mobiles | User Login Details';
		$body  = "<h1>Budget Computer & Kiwi Mobiles </h1> ";
		$body  .= "<p><img src='https://kiwimobiles.co.nz/jobform/wp-content/themes/nzstore/reources//images/logo.png' width='320px'></img></p><hr/> ";
		$body  .= "<p><strong> Username: </strong> $to </p> ";
		$body  .= "<p><strong> Password:   </strong> $password </p> ";
		$body  .= "<h1 style='color:#5fb227;margin:20px 0;'> YOUR ONLINE REPAIR PARTNER </h1>";
		$body  .= "<p>Thanks for subscribing to your online repair centre portal; now you can create your first query for any of your repair issues, the Galaxies series, iPhones, iPods, MacBooks, Laptops, X-BOX, and Gaming Machines. </p>";
		$body  .= "<p>We often stock all parts of the products mentioned above to repair fast. Online portal updates of your queries are generated until we receive your product repair and send them back with online tracking details in your dedicated login portal with us.  </p>";
		$body  .= "<p><strong> Email: </strong>  budgetcomputer@kiwimobiles.co.nz </p> ";
		$body  .= "<p><strong> DID: </strong>  073477044 -  099508717 </p> ";
		$body  .= "<p> <a href='http://icsservices.nz' target='_blank'>www.icsservices.nz </a>   &nbsp;&nbsp;&nbsp;  <a href='http://smartphonesrepair.co.nz' target='_blank'> www.smartphonesrepair.co.nz</a> </p> ";
		$body  .= "<p>Follow Us</p>";
		$body  .= "<p> <a href='https://www.facebook.com/smartphonesrepair.co.nz' target='_blank'>Facebook</a> &nbsp;&nbsp;&nbsp; <a href='https://www.youtube.com/channel/UC9DOgY5L5oAudmVE8V5D66g' target='_blank'>Youtube</a><p> ";
		$headers[] = 'From: budgetcomputer@kiwimobiles.co.nz" . "\r\n';
		$headers[] = "Content-Type: text/html; charset=UTF-8\r\n";
		wp_mail( $to, $subject, $body, $headers );
	}

	// Send Admint Notification 


	function sendmail_admin($user_email) {
		$admin = 'choudhry.asif@gmail.com';
		$subject = 'Budget Computer & Kiwi Mobiles | New User Registerd  ';
		$body  = "<h1>Budget Computer & Kiwi Mobiles </h1> ";
		$body  .= "<p><img src='https://kiwimobiles.co.nz/jobform/wp-content/themes/nzstore/reources//images/logo.png' width='320px'></img></p><hr/> ";
		$body  .= "<p><strong> Email Address: </strong> $user_email </p> ";
		$headers[] = 'From: budgetcomputer@kiwimobiles.co.nz" . "\r\n';
		$headers[] = 'Cc: choudhry.asif@gmail.com';
		$headers[] = 'Cc: budgetcomputer2013@gmail.co';
		$headers[] = 'Cc: uziasif06@gmail.com';
		$headers[] = "Content-Type: text/html; charset=UTF-8\r\n";
		wp_mail( $admin, $subject, $body, $headers );
	}
