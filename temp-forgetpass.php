<?php
/*
 * Template Name: Forget
 */

get_header('landing');
global $current_user;
$logged_user = wp_get_current_user();
$UIL =  $logged_user->user_login;
$uid =  $logged_user->ID;


if ( is_user_logged_in() ) {
  
    //echo "Redirect If user is login";

//wp_redirect('http://www.nannyportfolio.com/account');
//exit();



} else {

//echo "Not Login" asdasdf'


}



?>



    <!-- login section  -->

    <section class="container login mt-5 mb-5" style="margin-bottom:5rem !important">



    <div class="row align-items-center">
            <div class="col-sm-12 col-md-6 left">
                <div class="login_image_wrapper">
                    <div class="image_card">
                        <img src="<?php bloginfo('template_directory'); ?>/reources/images/mobile.jpg" alt="" style="width:100%; border-radius:20px">
                        <div class="overlay"></div>
                    </div>                    
                </div>               
            </div>
            <div class="col-sm-12 right col-md-6 p-3">
                 <img src="<?php bloginfo('template_directory'); ?>/reources/images/logo.png" alt="" style="max-width:350px" > <br/><br/>
                <h3>Welcome to Budget Computer & Kiwi Mobiles</h3>
                <p>1191 Eruera street Rotrua, 3010 </p>
                <p>DID : 073477044 </p>
                <form class="resetpassword" id="resetpassword">
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" class="form-control border-0 border-bottom rounded-0"
                            id="username" aria-describedby="emailHelp" placeholder="abc@example.com" value="" required>                  
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center " style="margin-top: 3rem !important;">
                    
                        <button type="submit" class="green_btn">Reset Password</button>

                        <a href="https://kiwimobiles.co.nz/jobform" class="green_btn">Login</a>
                    </div>
                    
                </form>
            </div>
        </div>

    </section>

    <!--x login section x -->

    
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
                            <h1 class="finished">Password Updated!</h1>
                            <h2 class="mb-5 mt-5">Please check your Email </h2>
                        </div>
                    </div>
                    
                </div>
                <img src="<?php bloginfo('template_directory'); ?>/reources//images/red cross.png" alt="" class="_cross">
            </div>
        </div>
    </section>

    <div id="spinner-div" class="pt-5">
        <div class="spinner-border text-primary" role="status">
        </div>
    </div>
  

    <?php wp_footer(); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
       

<script type="text/javascript">   
   jQuery(document).ready(function($) {  
    
   
    
    
    $('._cross').click(function(){
           
           $(".hideme").css("display", "none");
       });
        $("#resetpassword").submit(function(e) {          
            e.preventDefault();
            $("#spinner-div").show();    
            var username = jQuery('#username').val();              
            jQuery.ajax({
            type:"POST",
            url:"<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "resetpassword",
                username : username              
            },
            beforeSend: function(){                    
                        $("#loader").show();
                    },
                    complete: function () {
                        $("#spinner-div").hide(); 
                    }, 
            success: function(response){
               
                $(".sucess_message").css("display", "flex");
            },
            error: function(results) {
                alert("Error");
            }
            });
        });
	
	});
	</script>


