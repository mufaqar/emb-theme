<?php /* Template Name: Agent-AddTicket  */ 
get_header();?> 
 <?php include('navigation.php'); ?>
 <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;?>

<div class="custom_container catering_form mt-5 mb-5">
    <div class="_info mt-5 mb-3">
        <h2>Create Ticket </h2>
    </div>
    <div class="_form p-4 pt-5 pb-5">
    <form class="add_ticket" id="add_ticket" action="#" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-4 mb-3">
                    <label for="">Select</label>
                    <div class="_select">
                        <select id="ticket_cat">                            
                            <?php   
                            $cat_tax = get_terms( array('taxonomy' => 'ticket_cat','hide_empty' => false ) ); 
                            foreach( $cat_tax as $cat )  {
                                        $cat_slug = $cat->term_id ;
                                        $cat_name = $cat->name ; ?>                            
                                        <option value="<?php echo $cat_slug; ?>" > <?php echo $cat_name; ?> </option>
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
                        <input type="text" value="" placeholder="Please enter title" id="title" required>
                        <input type="hidden" value="<?php echo $uid ?>"  id="uid" >
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0 mb-3">
                    <label for="">Date</label>
                    <div class="_select">
                        <input type="date" value="<?php echo date("Y-m-d"); ?>" placeholder="02-05-22" id="date" required>
                    </div>
                </div>

                
                <div class="col-md-6 mb-3">
                    <label for="">Status </label>
                    <div class="_select">
                        <select id="ticket_status">                            
                            <?php   
                            $types_tax = get_terms( array('taxonomy' => 'ticket_status','hide_empty' => false ) ); 
                            foreach( $types_tax as $type )  {
                                        $type_slug = $type->term_id ;
                                        $type_name = $type->name ; ?>                            
                                        <option value="<?php echo $type_slug; ?>" > <?php echo $type_name; ?> </option>
                                            <?php
                                }                                                    
                            ?>
                        </select>
                        <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                    </div>
                </div>
               
                <div class="col-md-6 mb-3">
                    <label for=""> Type</label>
                    <div class="_select">
                        <select id="ticket_type">
                        <?php   
                            $food_categories = get_terms( array('taxonomy' => 'ticket_type','hide_empty' => false ) ); 
                            foreach( $food_categories as $food_cat )  {
                                        $food_cat_slug = $food_cat->term_id ;
                                        $food_cat_name = $food_cat->name ; ?>                            
                                        <option value="<?php echo $food_cat_slug; ?>" > <?php echo $food_cat_name; ?> </option>
                                            <?php
                                }                                                    
                            ?>
                        </select>
                        <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Priority</label>
                    <div class="_select">
                        <select id="ticket_priority">
                    <?php   
                            $product_tax = get_terms( array('taxonomy' => 'ticket_priority','hide_empty' => false ) ); 
                            foreach( $product_tax as $product_cat )  {
                                        $product_cat_slug = $product_cat->term_id ;
                                        $product_cat_name = $product_cat->name ; ?>                            
                                        <option value="<?php echo $product_cat_slug; ?>" > <?php echo $product_cat_name; ?> </option>
                                            <?php
                                }                                                    
                            ?>
                         </select>
                        <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                    </div>
                </div>            

                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Address</label>
                    <div class="_select">                    
                        <textarea id="address"><?php echo get_post_meta($pid, 'address', true ); ?></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                <label for="">Issue Details</label>
                    <div class="_select">                       
                        <textarea id="issues"><?php echo get_post_meta($pid, 'issues', true ); ?></textarea>
                    </div>
                </div>

              
                <div class="col-md-6 mb-3">
                <label for="">Shipping Details</label>
                    <div class="_select">                        
                        <textarea id="shipping"><?php echo get_post_meta($pid, 'shipping', true ); ?></textarea>
                    </div>
                </div>
                <div class="col-md-12 mb-3">                       
                    <div class="upload_file">
                            <div class="upload_icon"><i class="fa-solid fa-camera"></i></div>
                            <input type="file" name="file" id="file"  class="dropify" > 
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                
                    <div class="_select">                       
                    <input type="checkbox" id="terms_conditions" name="terms_conditions" value="Accept" required>
                    <label for="terms_conditions">Accept Terms and Conditions</label> <br/>
                    <a id="terms_btn" class="btn_primary">Read Terms and Condtions</a>
                    </div>
                </div>

                <div class="d-flex justify-content-end savebtn">
                    <input type="submit" class="btn_primary"  value="Add Ticket"/>
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
                            <h2 class="mb-5 mt-5">Your Ticket has beed created!</h2>
                        </div>
                    </div>
                    
                </div>
                <img src="<?php bloginfo('template_directory'); ?>/reources//images/red cross.png" alt="" class="_cross">
            </div>
        </div>
    </section>



    <section class="hideme overlay term_popup">
        <div class="popup">
        <form class="update_agreement" id="update_agreement" action="#" > 
                <div class="popup_wrapper">
                    <h3 class="ad_productss">Terms and Conditions </h3>               
                    <div class="termlist">
                    <ul>
                        <li> Diagnosed fees will apply for all repairs even if the gadget is not repairable or the customer cancels the job. </li>
                        <li> A part order on the customer's behalf and a deposit of 50% is taken. The warranty is non-refundable as we order the part on the customer's behalf. </li>
                        <li> All the parts fined come with a three-month warranty unless specified. We will fix the fault & check with which gadget is booked. No other-􀃒functionality is limited unless a thorough assessment is requested & assessment fee is paid. Also, provide the password or login id. </li>
                        <li> All repairs come with three months warranty unless specified. LCDs are fragile. Any external pressure in the pocket or any other place or harsh use will break without damaging the top glass, as the entire glass is more complicated/robust than underneath the LCD. In such a case, the warranty will be voided. </li>
                        <li> Any physical damage, which includes liquid damage, drops, and any pressure on the LCD which breaks the display, will not be covered in the warranty. Any gadget returned under contract, and if it is found to be physical damage, diagnostic will apply. In any dispute, the customer must get a third-party opinion on their own cost from a reputable repair shop and provide a copy of the report. </li>
                        <li> Warranty is provided only on the part we have replaced, not any other part of the gadget </li>
                        <li> No responsibility for any data loss while working on any gadget. Back up all your data before it is booked for repair. </li>
                        <li> The customer is responsible for picking up their gadget within two months after it is fixed and paying the repairing fee in full. No gadget will be delivered if not aided In full or sold my device is not picked up within two months, it will be disposed of or sold to recover the cost. I authorise the budget computer to dispose of or sell my gadget to recover the price if not picked up and paid within two months. </li>
                        <li> Warranty repair cannot be checked straight away. We need reasonable time to check and fix it. </li>
                        <li> Software/ operating system installation if a virus is infected or corrupted by customer negligence or misuse or any third-party software is not working, no responsibility is taken. </li>
                        <li>I read, agreed and acknowledged the above rubrics.</li>
                    </ul>
                        
                    </div>
                                      
                   
                    
                    <img src="<?php bloginfo('template_directory'); ?>/reources/images/red cross.png" alt="" class="_cross">
                </div>
            </form>
        </div>
    </section>


    <?php get_footer();?>

     <!-- Font Awsome -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">   
     jQuery(document).ready(function($) {	

        $('#terms_btn').click(function(){            
                $(".term_popup").css("display", "block");
            });


        $('._cross').click(function(){
           
           $(".hideme").css("display", "none");
       });
                 
        $("#add_ticket").submit(function(e) {                     
            e.preventDefault();   
            $("#spinner-div").show();                     
            var title = jQuery('#title').val();	             
            var date = jQuery('#date').val();	       
            var address = jQuery('#address').val();	             
            var ticket_type = jQuery('#ticket_type').val();	 
            var ticket_priority = jQuery('#ticket_priority').val();	 
            var ticket_status = jQuery('#ticket_status').val();	  
            var ticket_cat = jQuery('#ticket_cat').val();	        
            var shipping = jQuery('#shipping').val();           
            var issues = jQuery('#issues').val(); 
            var uid = jQuery('#uid').val();    
            var file_data = jQuery('#file').prop('files')[0]; 
            file_data = jQuery('#file').prop('files')[0];
            form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('action', 'add_ticket');
            form_data.append('title', title);
            form_data.append('date', date);	
            form_data.append('address', address); 
            form_data.append('ticket_type', ticket_type); 
            form_data.append('ticket_priority', ticket_priority); 
            form_data.append('ticket_status', ticket_status);  
            form_data.append('ticket_cat', ticket_cat);  
            form_data.append('issues', issues);  
            form_data.append('shipping', shipping);  
            form_data.append('user_type', "Agent");  
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

                           alert(data.message);
                        }  
                        else {
                           $(".sucess_message").css("display", "flex");
                      
                        }      
                    }
            
             });
         }); 
            
        
     });
	</script>













