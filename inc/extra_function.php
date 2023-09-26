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


add_filter( 'manage_records_posts_columns', 'set_custom_edit_records_columns' );    
add_action( 'manage_records_posts_custom_column' , 'custom_records_column', 10, 2 );
function set_custom_edit_records_columns($columns) {    
    unset( $columns['author'] );   
 
    $columns['devname'] = 'Name';
    $columns['devnum'] = 'Number';
    $columns['operdate'] = 'Date';
    $columns['opertime'] = 'Time';
    $columns['qty_total'] = 'Qty';

    

    return $columns;    
}

function custom_records_column( $column, $post_id ) {   
    global $post;
    switch ( $column ) {
        case 'devname' :
            if(get_post_meta($post_id, "devname", true)) {
               
                echo get_post_meta($post_id, "devname", true);
            } else {
                echo 0;
            }
        break;

        case 'devnum' :
            if(get_post_meta($post_id, "devnum", true)) {
            
                echo get_post_meta($post_id, "devnum", true);
            } else {
                echo 0;
            }
        break;  
        case 'operdate' :
            if(get_post_meta($post_id, "operdate", true)) {
           
              echo get_post_meta($post_id, "operdate", true);
          } else {
              echo 0;
          }
      break; 
      break;  
        case 'opertime' :
            if(get_post_meta($post_id, "opertime", true)) {
   
              echo get_post_meta($post_id, "opertime", true);
          } else {
              echo 0;
          }
      break; 
      break;  
        case 'qty_total' :
            if(get_post_meta($post_id, "qty_total", true)) {
          
              echo get_post_meta($post_id, "qty_total", true);
          } else {
              echo 0;
          }
      break;    
    }   
}

function records_column_register_sortable( $columns ) {
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




  

       // Add a custom cron schedule
        add_filter('cron_schedules', 'ecm_cron_importdata');
        function ecm_cron_importdata($schedules) {
            $schedules['every_forty_five_minutes'] = array(
                'interval' => 2700,
                'display' => 'Every 45 Minutes'
            );
            return $schedules;
        }

        // Schedule an action if it's not already scheduled
        if (!wp_next_scheduled('ecm_cron_importdata')) {
            wp_schedule_event(time(), 'every_forty_five_minutes', 'ecm_cron_importdata');
        }



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
              $opertime = $array_data->opertime;    
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
                      'opertime' => $opertime,
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

add_action('ecm_cron_importdata', 'call_api_with_times');


function get_terminal_info($UID) {
    $ter_args = array(
        'post_type' => 'terminals',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'terminal_company',
                'value' => $UID,
                'compare' => '=',
            ),
        ),
    );
    $terminal_query = new WP_Query($ter_args);
    $terminal_count = $terminal_query->found_posts;
    $terminal_titles = array();
    if ($terminal_query->have_posts()) {
        while ($terminal_query->have_posts()) {
            $terminal_query->the_post();
            $post_title = get_the_title();
            $terminal_titles[] = $post_title;
        }
        wp_reset_postdata(); 
    }
    return array(
        'terminal_count' => $terminal_count,
        'terminal_titles' => $terminal_titles,
    );
}


function get_branch_info($UID) {
$args = array(
    'post_type' => 'branch', 
    'posts_per_page' => -1, 
    'meta_query' => array(
        array(
            'key' => 'branch_company', 
            'value' => $UID, 
            'compare' => '=',
        ),
    ),
);
$custom_query = new WP_Query($args);  
$post_count = $custom_query->found_posts;
wp_reset_postdata();
return array(
    'branch_count' => $post_count,
   
);
}