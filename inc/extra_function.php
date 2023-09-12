<?php
include_once('login.php');
include_once('register.php');
include_once('cpts.php');
include_once('class-wp-bootstrap-navwalker.php');
include_once('ajax_request.php');


add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}

add_role( 'company', 'Company', get_role( 'company' )->capabilities );


add_filter( 'manage_tickets_posts_columns', 'set_custom_edit_tickets_columns' );    
add_action( 'manage_tickets_posts_custom_column' , 'custom_tickets_column', 10, 2 );
function set_custom_edit_tickets_columns($columns) {    
    unset( $columns['author'] );   
 
    $columns['user_type'] = 'User Type';
    $columns['order_uid'] = 'Order By';
    $columns['order_price'] = 'Price';

    return $columns;    
}

function custom_tickets_column( $column, $post_id ) {   
    global $post;
    switch ( $column ) {
        case 'order_status' :
            if(get_field( "order_status", $post_id )) {
                echo get_field( "order_status", $post_id );
            } else {
                echo 0;
            }
        break;

        case 'order_type' :
            if(get_field( "order_type", $post_id )) {
                echo get_field( "order_type", $post_id );
            } else {
                echo 0;
            }
        break;  
        case 'user_type' :
          if(get_field( "user_type", $post_id )) {
              echo get_field( "user_type", $post_id );
          } else {
              echo 0;
          }
      break; 
      break;  
        case 'order_price' :
          if(get_field( "price", $post_id )) {
              echo get_field( "price", $post_id );
          } else {
              echo 0;
          }
      break; 
      break;  
        case 'order_uid' :
          if(get_field( "order_uid", $post_id )) {
              echo get_field( "order_uid", $post_id );
          } else {
              echo 0;
          }
      break;    
    }   
}

function tickets_column_register_sortable( $columns ) {
     $columns['order_status'] = 'order_status';
    $columns['order_type'] = 'order_type';
    return $columns;
}



function hide_admin_bar_except_one_email() {
    if (!is_user_logged_in()) {
        return;
    }

    $allowed_email = 'mufaqar@gmail.com'; // Replace with your allowed email address
    $current_user = wp_get_current_user();
    $user_email = $current_user->user_email;

    if ($user_email !== $allowed_email) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'hide_admin_bar_except_one_email');








function Generate_Token() {
    $url = 'https://saven.jcen.cn/pwsys/sys/gettoken';
    $args = array(
        'body' => json_encode(array(
            'appid' => 'shabbir',
            'appsecret' => 'shabbir-123',
            'code' => '892894b98ceb5f11660d6cd3fff5c3d1',
        )),
        'headers' => array(
            'Content-Type' => 'application/json',
        ),
        'method' => 'POST',
        'sslverify' => false, // Set to true to enable SSL verification
    );
    
    $response = wp_remote_request($url, $args);
    if (is_array($response) && !is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
    
        if ($data['result']['token']) {
            $token = $data['result']['token'];
           $expiration_timestamp = time() + 30 * 60; // 30 minutes * 60 seconds/minute
            update_option('system_token', $token);
            update_option('system_token_expiration', $expiration_timestamp);
    
        } else {
            // Handle the case where the token is not present in the response
        }
    } else {
        // Handle the API request error
    }
  }
  
  function Is_Token_Expired() {
    // Get the stored token and its expiration timestamp from the database
    $token = get_option('system_token');
    $expiration_timestamp = get_option('system_token_expiration');
    // Check if the token has expired
    if ($token && $expiration_timestamp && $expiration_timestamp > time()) {
      return $token; // Token is not expired
    } else {
      Generate_Token();
      echo "Toke Regenerated";
    }
  }






add_filter( 'cron_schedules', 'ecm_cron_importdata' );

        function ecm_cron_importdata( $schedules ) {
            $schedules['every_fouthyfive_minutes'] = array(
                'interval'  => 2700,
                'display'   => 'Every 45 Minutes'
            );
            return $schedules;
        }
        
        // Schedule an action if it's not already scheduled
        if ( ! wp_next_scheduled( 'ecm_cron_importdata' ) ) {
            wp_schedule_event( time(), 'every_fouthyfive_minutes', 'ecm_cron_importdata' );
        }

// Schedule a cron job to run call_api_with_times function every 30 minutes
function schedule_api_cron_job() {
  if (!wp_next_scheduled('api_cron_event')) {
    //  wp_schedule_event(time(), 'every_thirty_minutes', 'api_cron_event');
   // wp_schedule_event(time(), 'per_minute', 'api_cron_event');
    wp_schedule_event( time(), 'every_fouthyfive_minutes', 'ecm_cron_importdata'. $args );
  }
}

// Hook the scheduling function
//add_action('init', 'schedule_api_cron_job');
//add_action( 'ecm_cron_importdata', 'call_api_with_times' );

// Define the function to be executed by the cron job
function call_api_with_times() {
  $token = get_option('system_token');
  $expiration_timestamp = get_option('system_token_expiration');
  if (!$token || !$expiration_timestamp || $expiration_timestamp < time()) {
      Generate_Token();
      return;
  }

  $api_url = 'https://saven.jcen.cn/pwsys/pwtransiot/pwTransIot/list_data';
  // Set the start and end times (30 minutes from now)
  $start_time = date('Y-m-d H:i:s', strtotime('+45 minutes'));
  $end_time = date('Y-m-d H:i:s', strtotime('+75 minutes'));

  $args = array(
      'body' => json_encode(array(
          'startTime' => $start_time,
          'endTime' => $end_time,
          'pageNo' => 1,
          'pageSize' => 1000,
      )),
      'headers' => array(
          'X-Access-Token' => $token,
          'Content-Type' => 'application/json',
      ),
      'method' => 'POST',
      'sslverify' => false,
      'timeout' => 180,
  );

  $response = wp_remote_post($api_url, $args);
  if ( is_wp_error( $response ) ) {
      // Handle the error, if any
  } else {
      $body = wp_remote_retrieve_body( $response );        
       $data = json_decode($body);
      // Access the "records" array
      $records = $data->result->records;

      if (is_wp_error($response)) {
          // Handle the error, if any
      } else {
          $body = wp_remote_retrieve_body($response);
          $data = json_decode($body);
      
          // Access the "records" array
          $records = $data->result->records;        
          foreach ($records as $array_data) {
              $id = $array_data->id;
              $stationid = $array_data->stationid;
              $transformerid = $array_data->transformerid;
              $transformername = $array_data->transformername;
              $devid = $array_data->devid;
              $devname = $array_data->devname;
              $devnum  = $array_data->devnum;
              $operdate = $array_data->operdate;
              $qty_total = $array_data->qty_total;
              $vol_a  = $array_data->vol_a;
              $relay1state = $array_data->relay1state;
              $power_a = $array_data->power_a;
              $amp_a = $array_data->amp_a;
              $post_title = $stationid . "-" . $id;
              $post_data = array(
                  'post_title' => $post_title,
                  'post_content' => $stationid,
                  'post_type' => 'records', 
                  'post_status' => 'publish',
                  'meta_input' => array(
                      'id' => $id,
                      'stationid' => $stationid,
                      'transformerid' => $transformerid,
                      'transformername' => $transformername,
                      'devid' => $devid,
                      'devname' => $devname,
                      'devnum' => $devnum,
                      'operdate' => $operdate,
                      'qty_total' => $qty_total,
                      'vol_a' => $vol_a,
                      'relay1state' => $relay1state,
                      'power_a' => $power_a,
                      'amp_a' => $amp_a,
                  )
              );
      
              // Insert the post with metadata
              $post_id = wp_insert_post($post_data);
              if (is_wp_error($post_id)) {
                  echo "Error inserting post: " . $post_id->get_error_message();
              } else {
                  echo "Post inserted with ID: " . $post_id . "<br>";
              }
          }
      }
      

    }



}
// Hook the custom function to the scheduled event
//add_action('api_cron_event', 'call_api_with_times');

