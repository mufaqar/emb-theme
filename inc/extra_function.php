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

add_role('agent', 'Agent', array(
    'read' => true, // True allows that capability, False specifically removes it.
    'edit_posts' => true,
    'delete_posts' => true,
    'edit_published_posts' => true,
    'publish_posts' => true,
    'edit_files' => true,
    'upload_files' => true //last in array needs no comma!
));

add_role( 'technician', 'Technician', get_role( 'agent' )->capabilities );


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

add_filter("manage_edit-tickets_sortable_columns", "tickets_column_register_sortable" );









add_filter( 'manage_orders_posts_columns', 'set_custom_edit_orders_columns' );    
add_action( 'manage_orders_posts_custom_column' , 'custom_orders_column', 10, 2 );
function set_custom_edit_orders_columns($columns) {    
    unset( $columns['author'] );   
 
    $columns['invoice_uid'] = 'Agent ID';
    $columns['order_id'] = 'Ticket ID';
    $columns['order_price'] = 'Price';

    return $columns;    
}

function custom_orders_column( $column, $post_id ) {   
    global $post;
    switch ( $column ) {
        case 'invoice_uid' :
            if(get_field( "invoice_uid", $post_id )) {
                echo get_field( "invoice_uid", $post_id );
            } else {
                echo 0;
            }
        break;

        case 'order_id' :
            if(get_field( "order_id", $post_id )) {
                echo get_field( "order_id", $post_id );
            } else {
                echo 0;
            }
        break;  
        
      break;  
        case 'order_price' :
          if(get_field( "order_price", $post_id )) {
              echo get_field( "order_price", $post_id );
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

function orders_column_register_sortable( $columns ) {
     $columns['order_status'] = 'order_status';
    $columns['order_type'] = 'order_type';
    return $columns;
}

add_filter("manage_edit-orders_sortable_columns", "orders_column_register_sortable" );









function  page_title() {

    ?> <div class='toggle mb-5'>
            <div class='tabs'>
                <div class='tab active'><?php the_title()?></div>           
            </div>
    </div><?php
}







    function reddirectProfile() {

        global $current_user;
        $logged_user = wp_get_current_user();
        $UIL =  $logged_user->user_login;
        $uid =  $logged_user->ID;
        $url = home_url();
        if ( is_user_logged_in() ) {
            wp_redirect($url);
            exit();
        
        } else {
        
        //echo "Not Login" ;
        
        
        }


    }


  
    function weekdaySort($a, $b){
        $weekdays = array("Monday","Tuesday","Wednesday","Thursday","Friday");
        return array_search($a, $weekdays) - array_search($b, $weekdays);
    } 
  


    function get_noftication($pid) {

          if((get_post_meta($pid, "notification", true))) { ?>
                <span class="noti_bag"><?php echo get_post_meta( $pid, 'notification', true ); ?></span>
            <?php } 



    }

    
    function toggleTabss(){
        ?>

<div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2 col-md-12 p-0">
                <div class="catering_menu all-tickets buttons">
                    <a id="1" class="showSingle _active" target="1" data="">All Tickets</a>
                    <a id="2" class="showSingle" target="2" data="Quotation">Quotation</a>
                    <a id="5" class="showSingle" target="5" data="Quotation-sent">Quotation Sent</a>
                    <a id="3" class="showSingle" target="2" data="Approval">Approval</a>
                    <a id="4" class="showSingle" target="2" data="Complete">Complete</a>
                </div>
            </div>
        </div>
    </div>

        <?php
    }     
  

    
	

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
        }
    
	


    add_action( 'template_redirect', 'wpse8170_activate_user' );
    function wpse8170_activate_user() {
        if ( is_page() && get_the_ID() == 179 ) {
            $user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) );
            if ( $user_id ) {        
                $code = get_user_meta( $user_id, 'has_to_be_activated', true );
                if ( $code == filter_input( INPUT_GET, 'key' ) ) {
                    delete_user_meta( $user_id, 'has_to_be_activated' );
                    add_user_meta( $user_id, 'user_activated', "yes" );
                    $user_info = get_userdata($user_id);
                    $user_email =  $user_info->user_login;
                    $password = generateRandomString();
                    wp_set_password($password,$user_id );
                    sendmail_agent($user_email,$password);
                    sendmail_admin($user_email);
                 
                  
                }
            }
        }
    }