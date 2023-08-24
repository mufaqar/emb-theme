<?php /* Template Name: Super-EditInvoice  */
get_header('admin');
$pid = $_REQUEST['id'];


$ticket_id  = get_post_meta($pid, 'order_id', true ); 
$user_id = get_post_meta( $pid, 'invoice_uid', true );
$user_info = get_userdata($user_id);  
$agent_email = $user_info->user_email;
?> 
 <?php include('navigation.php'); ?>
 <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;  ?>
<div class="custom_container catering_form mt-5 mb-3">
    <div class="_info mt-5 mb-5">
        <h2>Edit Inovice</h2>
    </div>
    <div class="_form  p-4 pt-5 pb-5">
    <form class="update_ticket" id="update_ticket" action="#" > 
            <div class="row">                
                <div class="col-md-6 mb-3">
                    <label for="">Inovice Id</label>
                    <div class="_select">
                        <input type="text" value="<?php echo get_the_title($pid)?>" placeholder="<?php echo get_the_title($pid)?>" id="title" disabled>
                        <input type="hidden" value="<?php echo $uid ?>"  id="uid" >
                        <input type="hidden" value="<?php echo $pid ?>"  id="pid" >
                    </div>
                </div> 
                <div class="col-md-6 mb-3">
                    <label for="">Ticket Id</label>
                    <div class="_select">
                        <input type="text" value="<?php echo $ticket_id ?>" placeholder="<?php echo $ticket_id ?>"  disabled>
                    </div>
                </div> 
                <div class="col-md-6 mb-3">
                    <label for="">Model No</label>
                    <div class="_select">
                        <input type="text" value="<?php echo get_the_title($ticket_id); ?>" placeholder="<?php echo get_the_title($ticket_id); ?>" disabled>
                    </div>
                </div>                
                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Agent</label>
                    <div class="_select">
                        <input type="text" value="<?php echo  $agent_email ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status </label>
                    <div class="_select">
                        <select id="order_status">                            
                            <?php   
                            $types_tax = get_terms( array('taxonomy' => 'order_status','hide_empty' => false ) ); 
                            $order_status  = get_the_terms( $pid, 'order_status');                        
                            foreach($order_status as $status)
                             {
                                $status_active =  $status->slug;
                             }   

                            foreach( $types_tax as $type )  {
                                        $type_slug = $type->term_id ;
                                        $type_name = $type->name ; ?>                            
                                        <option value="<?php echo $type_slug; ?>"  <?php if($status_active == $type->slug) { echo "selected";} ?> > <?php echo $type_name; ?> </option>
                                            <?php
                                }                                                    
                            ?>
                        </select>
                        <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                <label for="">Invocie Price</label>
                    <div class="_select">
                        <input type="text" id="order_price" value="<?php echo get_post_meta($pid, 'order_price', true ); ?>" >                        
                    </div>
                </div>  

                <div class="col-md-6 mb-3">
                <label for="">Amout Paid</label>
                    <div class="_select">
                        <input type="text" id="order_price_paid" value="<?php echo get_post_meta($pid, 'order_price_paid', true ); ?>" >                        
                    </div>
                </div>  
                
           

                <div class="col-md-6 mb-3">
                <label for="">Admin Remarks</label>
                    <div class="_select">                      
                        <textarea id="admin_remarks" ><?php echo get_post_meta($pid, 'admin_remarks', true ); ?></textarea>
                    </div>
                </div>              
               
                
               
                <div class="d-flex justify-content-end savebtn">
                    <input type="submit" class="btn_primary"  value="Update Invoice"/>
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
                            <h2 class="mb-5 mt-5">Your Inovice has beed updated!</h2>
                        </div>
                    </div>
                    
                </div>
                <img src="<?php bloginfo('template_directory'); ?>/reources//images/red cross.png" alt="" class="_cross">
            </div>
        </div>
    </section>
    <?php get_footer();?> 

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">   
     jQuery(document).ready(function($) {	
        $('._cross').click(function(){
           
           $(".hideme").css("display", "none");
       });
                 
        $("#update_ticket").submit(function(e) {                     
            e.preventDefault();  
            $("#spinner-div").show();   
            var pid = jQuery('#pid').val();	
            var order_status = jQuery('#order_status').val();	     
            var price = jQuery('#order_price').val();            
            var order_price_paid = jQuery('#order_price_paid').val();           
            var admin_remarks = jQuery('#admin_remarks').val(); 
            $.ajax(
                {
                    type:"POST",
                    url:"<?php echo admin_url('admin-ajax.php'); ?>",
                    data: {
                        action: "admin_update_invoice",
                        pid : pid,
                        order_status : order_status,
                        order_price_paid : order_price_paid, 
                        admin_remarks : admin_remarks,                       
                        price : price
                    
                    },   
                    beforeSend: function(){                    
                        $("#loader").show();
                    },
                     complete: function () {
                        $("#spinner-div").hide(); 
                    },
                    success: function(data){                      
                     
                        if(data.code==0) {
                           $(".overlay").css("display", "flex");
                        }  
                        else {
                          
                          
                       $(".overlay").css("display", "flex");
                      
                        }      
            }
            
             });
         }); 
            
        
     });
	</script>













