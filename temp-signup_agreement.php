<?php /* Template Name: AgentSignup  */ 
        get_header();
        reddirectProfile();
                ?> 
 <main class="business_agreement">
        <div class="agreement_wrapper d-flex position-relative justify-content-center flex-column align-items-center p-4">
                <a href="<?php echo home_url(); ?>"> <img src="<?php bloginfo('template_directory'); ?>/reources/images/logo.png" class="logo" alt="logo"></a>
                
                <form class="add_agent" id="add_agent" action="#" > 
                    <div class="d-flex justify-content-center flex-column align-items-center text-center">
                    <a href="<?php echo home_url(); ?>"> <img src="<?php bloginfo('template_directory'); ?>/reources/images/left arrow.png" class="arrow position-absolute" alt="back arrow"> </a>
                    <h2 class="">Create User Profile</h2>   
                    <p>Register With Us for Your Smarphone, Laptop, Ipads, Iphones, Samsung Galaxy,<br/> X-box, Gamingmachine,
Repair Diagnostic @ Competitive Prices</p>
                        <div id="first_step" class="pl-4 pt-3 pr-4 ">
                            
                        <div class="form-group w-100  mb-2">
                                <label for="compnay_name">Your Name</label>
                                <input type="text" class="form-control" id="agent_name" placeholder="Agent Name" required >
                            </div>
                            <div class="form-group w-100  mb-2">
                                <label for="compnay_delivery_address">Email adress</label>
                                <input type="text" class="form-control" id="agent_email"  placeholder="Enter Your Email adress" />                      
                            </div>

                            <div class="form-group w-100  mb-2">
                                <label for="business_address">Business Address</label>
                                <input type="text" class="form-control" id="business_address" placeholder="Enter your business address" >
                            </div>
                            <div class="form-group w-100  mb-2">
                                <label for="business_phone">Business Phone Number</label>
                                <input type="text"  class="form-control" id="business_phone" placeholder="Enter Business Phone Number" />
                                    </div>
                            <div class="form-group w-100  mb-2">                            
                                    <label for="business_name">Business Name</label>
                            <input type="text" class="form-control" id="business_name"  placeholder="Enter Your Business Name" >
                            </div>
                            <div class="form-group w-100  mb-2">
                                    <label for="postal_code">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code"  placeholder="Enter Your Postal Code" >
                            </div>
                            <div class="pinfo mb-5">
                            <div class="_select">                       
                    <input type="checkbox" id="terms_conditions" name="terms_conditions" value="Accept" required>
                    <label for="terms_conditions">Accept Terms and Conditions</label> <br/>
                    <a id="terms_btn" class="btn_primary">Read Terms and Conditions</a>
                    </div>
                            </div>
                            <button type="submit" class="btn_primary d-block next">Sign Up</button>                   
                        </div>
                    </div>      
                </form>
                <div id="last_step">
                    <div  class="finish_step step_wrapper d-flex justify-content-center flex-column align-items-center text-center">            
                        <div class="content mt-5">
                            <div class="right"><img src="<?php bloginfo('template_directory'); ?>/reources/images/img 3.png" alt=""></div>
                            <h1 class="finished">Your Request Sent!</h1>                          
                            <p class="find_information m-5">Please check your email inbox and activate your account </p>             
                            
                        </div>                    
                    </div>
                </div>    
            </div>
    </main>    
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
    

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">   
     jQuery(document).ready(function($) {	


        $('#terms_btn').click(function(){            
                $(".term_popup").css("display", "block");
            });
            $('._cross').click(function(){
           
           $(".hideme").css("display", "none");
       });

        $("#add_agent").submit(function(e) {                     
            e.preventDefault();   
            $("#spinner-div").show();                     
            var agent_name = jQuery('#agent_name').val();  
            var agent_email = jQuery('#agent_email').val();        
            var business_address = jQuery('#business_address').val();	
            var business_name = jQuery('#business_name').val();	
            var business_phone = jQuery('#business_phone').val();	 
            var postal_code = jQuery('#postal_code').val();	     
            form_data = new FormData();
            form_data.append('action', 'agent_create_signup');
            form_data.append('agent_name', agent_name);
            form_data.append('agent_email', agent_email);	
            form_data.append('business_address', business_address); 
            form_data.append('business_name', business_name); 
            form_data.append('business_phone', business_phone); 
            form_data.append('postal_code', postal_code);  
            
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
                            $("#first_step").css("display", "none");  
                            $("#last_step").css("display", "flex");                      
                        }      
                    }
            
             });
         }); 
            
        
     });
	</script>








