<?php
add_action('wp_ajax_userlogin', 'userlogin', 0);
add_action('wp_ajax_nopriv_userlogin', 'userlogin');
function userlogin() {	
	  $username = stripcslashes($_POST['username']);
	  $password = stripcslashes($_POST['password']);
	  global $wpdb;  
    //We shall SQL escape all inputs  
    $username = $wpdb->escape($_REQUEST['username']);  
    $password = $wpdb->escape($_REQUEST['password']);  
    $remember = $wpdb->escape($_REQUEST['rememberme']);  
    // if($remember) $remember = "true";  $remember = "false"; 
    $login_data = array();  
    $login_data['user_login'] = $username;  
    $login_data['user_password'] = $password;  
    $login_data['remember'] = $remember;  
    $user_verify = wp_signon( $login_data, false );   
   
      if ( is_wp_error($user_verify) )   {            
             echo wp_send_json( array('code' => 0 , 'message'=>__('Please Enter Corrent Username and Password')));
      } else {   
       // echo "your are logged in";
      } 	
		
}

