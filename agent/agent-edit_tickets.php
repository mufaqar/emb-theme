<?php /* Template Name: Agent-EditTicket  */ 
get_header();
$pid = $_REQUEST['id'];
?> 
 <?php include('navigation.php'); ?>
 <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;  ?>

<div class="custom_container catering_form mt-5">
    <div class="_info mt-5 mb-5">
        <h2>Edit Ticket</h2>
    </div>
    <div class="_form  p-4 pt-5 pb-5">
    <form class="update_ticket" id="update_ticket" action="#" > 
            <div class="row">
                <div class="col-md-4 mb-3">
                        <label for="">Select</label>
                        <div class="_select">
                            <select id="ticket_cat">                            
                                <?php   
                                $cat_tax = get_terms( array('taxonomy' => 'ticket_cat','hide_empty' => false ) ); 
                                $cat_status  = get_the_terms( $pid, 'ticket_cat');                        
                                foreach($cat_status as $cat_selected)
                                {
                                    $cat_active =  $cat_selected->slug;
                                }   
                                foreach( $cat_tax as $cat )  {
                                            $cat_slug = $cat->term_id ;
                                            $cat_name = $cat->name ; ?>                            
                                            <option value="<?php echo $cat_slug; ?>" <?php if($cat_active == $cat->slug) { echo "selected";} ?>  > <?php echo $cat_name; ?> </option>
                                                <?php
                                    }                                                    
                                ?>
                            </select>
                            <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                        </div>
                    </div>
                <div class="col-md-4 mb-3">
                    <label for="">Model No</label>
                    <div class="_select">
                        <input type="text" value="<?php echo get_the_title($pid)?>" placeholder="<?php echo get_the_title($pid)?>" id="title" required>
                        <input type="hidden" value="<?php echo $uid ?>"  id="uid" >
                        <input type="hidden" value="<?php echo $pid ?>"  id="pid" >
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0 mb-3">
                    <label for="">Date</label>
                    <div class="_select">
                        <input type="date" value="<?php echo get_post_meta($pid, 'date', true ); ?>"  id="date" required>
                    </div>
                </div>
                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Address</label>
                    <div class="_select">
                        <input type="text" value="<?php echo get_post_meta($pid, 'address', true ); ?>" id="address" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status </label>
                    <div class="_select">
                        <select id="ticket_status">                            
                            <?php   
                            $types_tax = get_terms( array('taxonomy' => 'ticket_status','hide_empty' => false ) ); 
                            $ticket_status  = get_the_terms( $pid, 'ticket_status');                        
                            foreach($ticket_status as $status)
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
                    <label for="">Type</label>
                    <div class="_select">
                        <select id="ticket_type">
                        <?php   
                            $food_categories = get_terms( array('taxonomy' => 'ticket_type','hide_empty' => false ) ); 
                            $ticket_types  = get_the_terms( $pid, 'ticket_type' );
                             foreach($ticket_types as $type)
                             {
                                $ticket_type_active =  $type->slug;
                             }
                                       
                            foreach( $food_categories as $food_cat )  {
                                        $food_cat_slug = $food_cat->term_id ;
                                        $food_cat_name = $food_cat->name ; ?>                            
                                        <option value="<?php echo $food_cat_slug; ?>" <?php if($ticket_type_active == $food_cat->slug) { echo "selected";} ?>> <?php echo $food_cat_name; ?> </option>
                                            <?php
                                }                                                    
                            ?>
                        </select>
                        <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for=""> Priority</label>
                    <div class="_select">
                        <select id="ticket_priority">
                    <?php   
                            $product_tax = get_terms( array('taxonomy' => 'ticket_priority','hide_empty' => false ) ); 
                            $ticket_priority  = get_the_terms( $pid, 'ticket_priority' );                        
                            foreach($ticket_priority as $priority)
                             {
                                $priority_active =  $priority->slug;
                             }   
                            foreach( $product_tax as $product_cat )  {
                                        $product_cat_slug = $product_cat->term_id ;
                                        $product_cat_name = $product_cat->name ; ?>                            
                                        <option value="<?php echo $product_cat_slug; ?>"<?php if($priority_active == $product_cat->slug) { echo "selected";} ?> > <?php echo $product_cat_name; ?> </option>
                                            <?php
                                }                                                    
                            ?>
                         </select>
                        <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                    </div>
                </div>            

                

                <div class="col-md-6 mb-3">
                <label for="">Issue Details(Agent Remarks)</label>
                    <div class="_select">                      
                        <textarea id="issues"><?php echo get_post_meta($pid, 'issues', true ); ?></textarea>
                    </div>
                </div>              
                <div class="col-md-6 mb-3">
                <label for="">Shipping Details( Agent )</label>
                    <div class="_select">                     
                        <textarea id="shipping"><?php echo get_post_meta($pid, 'shipping', true ); ?></textarea>
                    </div>
                </div> 
                <div class="col-md-6 mb-3">
                <label for=""> Technician Remarks</label>
                    <div class="_select">                     
                        <textarea id="eng_remarks" disabled><?php echo get_post_meta($pid, 'eng_remarks', true ); ?></textarea>
                    </div>
                </div>  

                <?php $price  = get_post_meta($pid, 'price', true );  
                
                if($price != '') { ?> <div class="col-md-6 mb-3">
                <label for=""> Estimated Price (Technician)</label>
                    <div class="_select">                     
                        
                        <input value="<?php echo get_post_meta($pid, 'price', true ); ?>"  disabled>
                    </div>
                </div>  <?php }  ?>

                

                 
                <div class="d-flex justify-content-end savebtn">
                    <input type="submit" class="btn_primary"  value="Update Ticket"/>
                </div>

                <div class="col-md-12 mb-3">   
                                      
                                <?php                            
                                        $attimages = get_attached_media('image', $pid);
                                        foreach ($attimages as $image) {
                                          
                                            $img_url = wp_get_attachment_url($image->ID);                                
                                            echo "<a href='$img_url' target='_blank' >";                             
                                            echo "<img src='$img_url' width='250px' class='img_box' />";                                      
                                            echo "</a>" ; 
                                          
                                        }                       


                                ?>   
                                </div>                       

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
                            <h2 class="mb-5 mt-5">Your order has beed updated!</h2>
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
            var title = jQuery('#title').val();	   
            var pid = jQuery('#pid').val();	             
            var date = jQuery('#date').val();	       
            var address = jQuery('#address').val();	             
            var ticket_type = jQuery('#ticket_type').val();	 
            var ticket_priority = jQuery('#ticket_priority').val();	 
            var ticket_status = jQuery('#ticket_status').val();	 
            var ticket_cat = jQuery('#ticket_cat').val();	
            var shipping = jQuery('#shipping').val();           
            var issues = jQuery('#issues').val(); 
            var uid = jQuery('#uid').val();      
           
            $.ajax(
                {
                    type:"POST",
                    url:"<?php echo admin_url('admin-ajax.php'); ?>",
                    data: {
                        action: "update_ticket",
                        pid : pid,
                        title : title,
                        date : date, 
                        address : address,
                        ticket_type : ticket_type,
                        ticket_priority : ticket_priority,
                        ticket_status : ticket_status ,
                        ticket_cat : ticket_cat ,
                        issues : issues,
                        shipping : shipping,
                        uid : uid
                    },   
                    beforeSend: function(){                    
                        $("#loader").show();
                    },
                     complete: function () {
                        $("#spinner-div").hide(); 
                    },
                    success: function(data){  
                        $(".overlay").css("display", "flex");                           
                     }
            
             });
         }); 
            
        
     });
	</script>













