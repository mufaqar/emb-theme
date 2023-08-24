<?php
/*
 * Template Name: Confirmation
 */

get_header('landing');



?>





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
                   <h3>Thank you for joining us</h3> 

                   <p>Please check your email for username and password</p> 

                  
                   <h6 class="mt-5 mb-5" ><a href="<?php echo home_url(); ?>" class="btn_primary  next">Login for Creating Tickets</a> </h6>                 
                                 
              
            </div>

            
        </div>

    </section>




    <?php wp_footer(); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
            <script src="<?php bloginfo('template_directory'); ?>/reources//js/slick-slider-script.js" type="text/javascript"></script>


        </body>
    </html>