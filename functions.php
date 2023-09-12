<?php

  load_theme_textdomain('dd_domain'); 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );
	add_image_size( 'single-post-thumbnail', 300, 9999 );
  add_image_size( 'product-thumbnail', 260, 220, true );

    

	// Add RSS links to <head> section
	//automatic_feed_links();
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
		// Declare sidebar widget zone
	if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h4>',
    		'after_title'   => '</h4>'
    	));
    }

function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

  if (function_exists('register_nav_menus')) {
  register_nav_menus( array(	
    
        
          'super' => __( 'Main Menu'),
          'company' => __( 'Company Menu'),
          'main' => __( 'Main Menu')

    ) );
  }

function fallbackmenu1(){ ?>
<div id="menu">
    <ul>
        <li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus
            to work.</li>
    </ul>
</div>
<?php }

function fallbackmenu2(){ ?>
<div id="menu">
    <ul>
        <li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus
            to work.</li>
    </ul>
</div>
<?php }

function add_more_buttons($buttons) {
 $buttons[] = 'hr';
 $buttons[] = 'del';
 $buttons[] = 'sub';
 $buttons[] = 'sup';
 $buttons[] = 'fontselect';
 $buttons[] = 'fontsizeselect';
 $buttons[] = 'cleanup';
 $buttons[] = 'styleselect';
 $buttons[] = 'lineheight';
 return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");

function add_first_and_last($items) {
    $items[1]->classes[] = 'first-menu-item';
    $items[count($items)]->classes[] = 'last-menu-item';
    return $items;
}
 
add_filter('wp_nav_menu_objects', 'add_first_and_last');

// Theme Options
//include_once('admin/index.php');
//Metabox
//include_once('metaboxes.php');
include_once('inc/extra_function.php');


function callback($buffer) {
    return $buffer;
}
function buffer_start() { ob_start("callback"); }
function buffer_end() { ob_end_flush(); }
add_action('init', 'buffer_start');
add_action('wp_footer', 'buffer_end');


// Enqueue Font Awesome 5 in WordPress 
function tme_load_font_awesome() {
    wp_enqueue_script( 'font-awesome-free', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js' );
}
add_action( 'wp_enqueue_scripts', 'tme_load_font_awesome' );


/* for javascript (only when using child theme) */
//wp_enqueue_script('url-script', home_url() );
//wp_localize_script('url-script', 'webpath', array('theme_path' => home_url()));



/* Disable WordPress Admin Bar for all users */
//add_filter( 'show_admin_bar', '__return_false' );


function enqueue_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), '1.0', true );
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


function load_subcategories() {
    $parent_id = $_POST['parent_id'];
    $subcategories = get_categories( array(
      'taxonomy' => 'cat_fault_type',
      'parent' => $parent_id,
      'hide_empty' => false
    ) );
    $output = '<option value="">Select a subcategory</option>';
    foreach ( $subcategories as $subcategory ) {
      $output .= '<option value="' . $subcategory->term_id . '">' . $subcategory->name . '</option>';
    }
    wp_send_json($output);
    wp_die();
  }
  add_action( 'wp_ajax_load_subcategories', 'load_subcategories' );
  add_action( 'wp_ajax_nopriv_load_subcategories', 'load_subcategories' );



  function update_post_title_with_meta() {
    $args = array(
      'post_type' => 'repair',
      'posts_per_page' => -1, 
    );
    $posts = get_posts( $args );
    foreach ( $posts as $post ) {
     // $new_title = get_post_meta( $post->ID, 'my_meta_field', true ); // Replace this with the meta field key you want to use

     // Model NO
      $term_model_nocat = get_the_terms($post->ID, 'model_cat' );
      $model_no_cat_name = $term_model_nocat[0]->name;   

      // Fault Cat
      $term_falt_cat = get_the_terms( $post->ID, 'cat_fault_type' );
      $falt_cat_name = $term_falt_cat[0]->name;
      //model type Cate
      $term_model_type_cat = get_the_terms($post->ID, 'model_type_cat' );	
      $model_type_name = $term_model_type_cat[0]->name;
      // Type 
      $term_type_cat = get_the_terms( $post->ID, 'repair_cat' );	
      $type_name = $term_type_cat[0]->name;
      
    $title =  $model_no_cat_name; 
     
     

      if ( !empty( $title ) ) {
        wp_update_post( array(
          'ID' => $post->ID,
          'post_title' => $title,
        
      
        ) );
      }
    }
  }
 // add_action( 'init', 'update_post_title_with_meta' );

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



        // $allposts= get_posts( array('post_type'=>'records','numberposts'=>-1) );
        // foreach ($allposts as $eachpost) {
        // wp_delete_post( $eachpost->ID, true );
        // }


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
add_action('init', 'schedule_api_cron_job');

add_action( 'ecm_cron_importdata', 'call_api_with_times' );

// Define the function to be executed by the cron job
function call_api_with_times() {
  $token = get_option('system_token');
  $expiration_timestamp = get_option('system_token_expiration');
  if (!$token || !$expiration_timestamp || $expiration_timestamp < time()) {
      Generate_Token();
      echo "Token Regenerated";
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
add_action('api_cron_event', 'call_api_with_times');
