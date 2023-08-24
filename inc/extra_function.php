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
