<?php
/*
 * Template Name: Login
 */

get_header('landing');
global $current_user;
$logged_user = wp_get_current_user();
$UIL =  $logged_user->user_login;
$uid =  $logged_user->ID;
$url = home_url('dashboard');
if ( is_user_logged_in() ) {

   
$user_info = get_userdata($uid);
$role = $user_info->roles;





if (in_array('administrator', $user_info->roles)) {
    $url = home_url('admin-dashboard');
    wp_redirect($url);
    exit();
    }
elseif (in_array('agent', $user_info->roles)) {
    $url = home_url('agent-dashboard'); 
    wp_redirect($url);
    exit();

    } 
    elseif (in_array('technician', $user_info->roles)) {
        $url = home_url('tech-dashboard'); 
        wp_redirect($url);
    exit();
    
        } 
else {
    $url = home_url('dashboard');
    wp_redirect($url);
    exit();


}



} else {

//echo "Not Login" ;


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
                <form class="login_form" id="loginform">
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" class="form-control border-0 border-bottom rounded-0"
                            id="username" aria-describedby="emailHelp" placeholder="abc@example.com" value="" required>                  
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control border-0 border-bottom rounded-0"
                            id="password" placeholder="Input your password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center " style="margin-top: 3rem !important;">
                        <span>Don't remember your <a href="<?php echo home_url('forget-password'); ?>">Password?</a></span>
                        <button type="submit" class="green_btn">Login</button>
                    </div>
                    
                </form>
            </div>
        </div>

    </section>

    <!--x login section x -->

  


    <?php wp_footer(); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
            <script src="<?php bloginfo('template_directory'); ?>/reources//js/slick-slider-script.js" type="text/javascript"></script>


        </body>
    </html>
<script type="text/javascript">   
   jQuery(document).ready(function($) {    
        $("#loginform").submit(function(e) {          
            e.preventDefault();
            var username = jQuery('#username').val();
            var password = jQuery('#password').val();       
            jQuery.ajax({
            type:"POST",
            url:"<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "userlogin",
                username : username,
                password : password
            },
            success: function(response){
              // alert(response.message);
               window.location.href = "<?php echo home_url('/login'); ?>";
            },
            error: function(response) {
                alert(response.message);
            }
            });
        });
	
	});
	</script>


