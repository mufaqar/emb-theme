<?php /* Template Name: Tech-EditTickets  */
get_header('admin');
$pid = $_REQUEST['id'];?> 
 <?php include('navigation.php'); ?>
 <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;  ?>
<div class="custom_container catering_form mt-2 mb-3">
    <div class="_info mt-5 mb-5">
        <h2>Update Ticket </h2>
    </div>
    <div class="_form  p-4 pt-5 pb-5">
    <form class="update_ticket" id="update_ticket" action="#" enctype="multipart/form-data">
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
                        <input type="text" value="<?php echo get_post_meta($pid, 'address', true ); ?>" id="address" disabled>
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
                        <textarea id="issues" disabled><?php echo get_post_meta($pid, 'issues', true ); ?></textarea>
                    </div>
                </div>              
                <div class="col-md-6 mb-3">
                <label for="">Shipping Details( Agent )</label>
                    <div class="_select">                     
                        <textarea id="shipping" disabled><?php echo get_post_meta($pid, 'shipping', true ); ?></textarea>
                    </div>
                </div>  
                

                <div class="col-md-6 mb-3">
                <label for="">Technician Remarks </label>
                    <div class="_select">                     
                        <textarea id="eng_remarks"><?php echo get_post_meta($pid, 'eng_remarks', true ); ?></textarea>
                    </div>
                </div> 

                <div class="col-md-6 mb-3">
                <label for="">Remarks (Internal) </label>
                    <div class="_select">                     
                        <textarea id="internal_remarks"><?php echo get_post_meta($pid, 'internal_remarks', true ); ?></textarea>
                    </div>
                </div> 
                <div class="col-md-6 mb-3">
                <label for="">Qoutation Price</label>
                    <div class="_select">
                        <input type="text" id="price" value="<?php echo get_post_meta($pid, 'price', true ); ?>" >                        
                    </div>
                </div>  

                <div class="col-md-12 mb-3">                       
                    <div class="upload_file">
                            <div class="upload_icon"><i class="fa-solid fa-camera"></i></div>
                            <input type="file" name="file" id="file"  class="dropify" > 
                    </div>
                </div>
               
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
        </form>
    </div>
</div>
</div>
</div>
</div>
</main>


<section class="hideme zindex-modal overlay sucess_message">
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
            var invoice = jQuery('#invoice').val(); 
            var price = jQuery('#price').val();             
            var uid = jQuery('#uid').val(); 
            var eng_remarks = jQuery('#eng_remarks').val();   
            var internal_remarks = jQuery('#internal_remarks').val();  

            var file_data = jQuery('#file').prop('files')[0]; 
            file_data = jQuery('#file').prop('files')[0];
            form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('action', 'tech_update_ticket');
            form_data.append('title', title);
            form_data.append('date', date);	
            form_data.append('address', address); 
            form_data.append('ticket_type', ticket_type); 
            form_data.append('ticket_priority', ticket_priority); 
            form_data.append('ticket_status', ticket_status);  
            form_data.append('ticket_cat', ticket_cat);  
            form_data.append('invoice', invoice);  
            form_data.append('eng_remarks', eng_remarks);  
            form_data.append('internal_remarks', internal_remarks); 
            form_data.append('price', price);  
            form_data.append('pid', pid);  
            form_data.append('uid', uid); 
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
                          // alert(data.message);
                        }  
                        else {
                          //  alert(data.message);
                           $(".sucess_message").css("display", "flex");
                      
                        }      
                    }
            
             });
         }); 
            
        
     });
	</script>













