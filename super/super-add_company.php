<?php /* Template Name: AddCompany  */ 
get_header();

?> 
 <?php include('navigation.php'); ?>
 <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;?>

<div class="custom_container catering_form mt-5 mb-5">
    <div class="_info mt-5 mb-3">
        <h2>Create Company  </h2>
    </div>
    <div class="_form p-4 pt-5 pb-5">
    <form class="add_ticket" id="add_ticket" action="#" enctype="multipart/form-data">
            <div class="row">
            
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <div class="_select">
                        <input type="text" value="" placeholder="Please enter name" id="name" required>
                    </div>
                </div>
                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Email</label>
                    <div class="_select">
                        <input type="email" value="" placeholder="Enter agent email address" id="email" required>
                    </div>
                </div>



                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Address</label>
                    <div class="_select">
                    <input type="text" value="" placeholder="Please Address" id="address" required>
                    </div>
                </div>

                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">City</label>
                    <div class="_select">
                    <input type="text" value="" placeholder="Please add city" id="city" required>
                    </div>
                </div>

                <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Country</label>
                    <div class="_select">
                    <input type="text" value="" placeholder="Please add country" id="country" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end savebtn">
                    <input type="submit" class="btn_primary"  value="Add Company"/>
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
                            <h2 class="mb-5 mt-5">We Have Create Company For you</h2>
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
            var email = jQuery('#email').val();	       
            var address = jQuery('#address').val();
            var city = jQuery('#city').val();
            var country = jQuery('#country').val();
            var user_type = jQuery('#user_type').val();
            form_data = new FormData();   
            form_data.append('action', 'add_company');
            form_data.append('name', name);
            form_data.append('email', email);	
            form_data.append('address', address);
            form_data.append('city', city);
            form_data.append('country', country);
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
                           $(".overlay").css("display", "flex");
                      
                        }      
            }
            
             });
         }); 
            
        
     });
	</script>













