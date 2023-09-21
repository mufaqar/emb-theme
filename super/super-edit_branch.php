<?php /* Template Name: Admin-EditBranch */ 
get_header();
$pid = $_REQUEST['pid'];


$branch_name = get_the_title($pid);
$branch_code = get_post_meta($pid , 'branch_code', true);
$branch_address = get_post_meta($pid , 'branch_address', true);
$branch_country = get_post_meta($pid , 'branch_country', true);

$terminal_company = get_post_meta($pid , 'terminal_company', true);

$branch_company = get_post_meta($pid , 'branch_company', true);

$location_terms = wp_get_post_terms($pid, 'location'); 







?> 
 <?php include('navigation.php'); ?>
 <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;   ?>

<div class="custom_container catering_form mt-5 mb-5">
    <div class="_info mt-5 mb-3">
        <h2>Edit Branch </h2>
    </div>
    <div class="_form p-4 pt-5 pb-5">
    <form class="add_ticket" id="add_ticket" action="#" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $pid ?>"  id="pid" required>
            <div class="row">            
                <div class="col-md-6 mb-3">
                    <label for="">Brnach Name</label>
                    <div class="_select">
                        <input type="text" value="<?php echo $branch_name ?>" placeholder="Please enter name" id="name" required>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="">Address</label>
                    <div class="_select">
                        <input type="text" value="<?php echo $branch_address ?>" placeholder="Please enter name" id="address" required>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="">Company </label>
                    <div class="_select">
                        <?php                     
                        $role = 'company';
                        $users = get_users( array(
                            'role' => $role,
                        ) );
                        ?>
                        <select name="user_select"  id="company">                            
                            <?php foreach ( $users as $user ) : ?>
                                <option value="<?php echo esc_attr( $user->ID ); ?>" <?php if ($user->ID == $branch_company) echo 'selected'; ?>>
                                    <?php echo esc_html( $user->display_name ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="">Branch Code</label>
                    <div class="_select">
                        <input type="text" value="<?php echo $branch_code ?>" placeholder="Please enter name" id="location_id" required>
                    </div>
                </div>  

                 <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Country</label>
                    <div class="_select">
                    <input type="text" value="<?php echo $branch_country ?>" placeholder="Please add country" id="country" required>
                    </div>
                </div>     

                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                <?php            
                       $terms = get_terms(array(
                        'taxonomy' => 'location',
                        'hide_empty' => false, 
                    ));
                        ?>
                <select class="selectpicker" data-live-search="true" multiple name="floor_section"  id="floor_section"> 
              
                    <?php  foreach ($terms as $term)  :  ?>
                                <option value="<?php echo esc_attr( $term->term_id); ?>" <?php
                                    foreach ($location_terms as $loc) {
                                        if ($term->term_id == $loc->term_id) {
                                            echo 'selected';
                                        }
                                    }                                                                    
                                
                                 ?>>
                                    <?php echo  $term->name ?>
                                </option>
                            <?php endforeach; ?>
                </select>
                </div>   

                <div class="d-flex justify-content-end savebtn">
                    <input type="submit" class="btn_primary"  value="Update Branch"/>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</main>


<section class="hideme zindex-modal overlay">
        <div class="popup">
            <div class="popup_wrapper">
                <div
                    class="order_confirm d-flex position-relative justify-content-center flex-column align-items-center p-4">
                    <img src="<?php bloginfo('template_directory'); ?>/reources/images/logo.png" class="logo" alt="logo">

                    <div
                        class="step_wrapper d-flex justify-content-center flex-column align-items-center text-center">
                        <div class="content mt-5">
                            <div class="right"><img src="<?php bloginfo('template_directory'); ?>/reources/images/img 3.png" alt=""></div>
                            <h1 class="finished">Finished!</h1>
                            <h2 class="mb-5 mt-5">We Have Update Branch For you</h2>
                        </div>
                    </div>
                    
                </div>
                <img src="<?php bloginfo('template_directory'); ?>/reources//images/red cross.png" alt="" class="_cross">
            </div>
        </div>
    </section>


    <?php get_footer();?>

     <!-- Font Awsome -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">   
     jQuery(document).ready(function($) {	
        $('._cross').click(function(){           
           $(".hideme").css("display", "none");
       });
                 
        $("#add_ticket").submit(function(e) {                     
            e.preventDefault();   
            $("#spinner-div").show();                     
            var name = jQuery('#name').val();	
            var pid = jQuery('#pid').val();	
            
            var address = jQuery('#address').val();	  
            var company = jQuery('#company').val();	
            var location_id = jQuery('#location_id').val();	
            var country = jQuery('#country').val();	
            var user_type = jQuery('#user_type').val();
            var floor_section = jQuery('#floor_section').val();
                       
            form_data = new FormData();   
            form_data.append('action', 'update_branch');
            form_data.append('name', name);
            form_data.append('pid', pid);
            form_data.append('address', address);
            form_data.append('company', company);
            form_data.append('location_id', location_id); 
            form_data.append('country', country);  
            form_data.append('floor_section', floor_section);                    
            form_data.append('user_type', user_type);
           
            $.ajax(
                {
                    url:"<?php echo admin_url('admin-ajax.php'); ?>",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: form_data,  
                    beforeSend: function(){                    
                        $("#loader").show();
                    },
                     complete: function () {
                        $("#spinner-div").hide(); 
                    }, 
                    success: function(data){                      
                     
                        if(data.code==0) {
                                    alert(data.message);
                        }  
                        else {
                        //   $(".overlay").css("display", "flex");
                      
                        }      
            }
            
             });
         }); 
            
        
     });
	</script>













