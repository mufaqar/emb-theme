<?php get_header(); ?>
           
<main class="launch_calandar">
        <div class="row d-flex">
            <div class="" style="width: 230px;">           
                <div class="sidebar p-0 align-items-start pt-5">
                    <div class="d-flex justify-content-center">
                       <a href="<?php bloginfo('url'); ?>"> <img src="<?php bloginfo('template_directory'); ?>/reources//images/logo.png" class="logo" alt=""></a>
                    </div>                    
                    <div class="mt-5">                        
                        <?php 	
								  wp_nav_menu ( array(
                                    'container'       => false,	
									'theme_location'  => 'agent',	
									'menu_class'      => 'myProfileNav activeNav'
								) );
								?>   
                    </div>
                    <div class="logout">                       	
                    <a href="<?php echo wp_logout_url( home_url() ); ?>"> <img src="<?php bloginfo('template_directory'); ?>/reources//images/logout.png" alt=""><span>Log Out</span></a>
                    </div>
                    <img src="<?php bloginfo('template_directory'); ?>/reources/images/cancel.png" class="hide_nav" alt="" onclick="HideNav()">
            </div>
        </div>    


        <div class="content">
                <div class="container_wrapper">
                    <div class="d-flex align-items-center justify-content-between mt-4">
                        <div class="hamburger">
                            <img src="<?php bloginfo('template_directory'); ?>/reources/images/hamburger.png" alt="" id="hamburgerbtn" onclick="hamburger()">
                        </div>
                        <div class="proofile_info d-flex align-items-center">
                        <div class="user">
                                <h6><?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;?>
                                    <?php if ( is_user_logged_in() ) { 
                                    echo 'Hey, ' .  $current_user->display_name . "<br/>" ; } 
                                    else {
                                        wp_redirect( home_url('login'));                                     
                                        exit;

                                    }
                                    global $user_login, $current_user; 
                                    get_currentuserinfo();
                                    $user_info = get_userdata($current_user->ID);
                                    $role = $user_info->roles;
                                    echo $role[0];                                   
                                   
                                    ?></h6>
                               </p>                            

                            </div>
                            <img src="<?php bloginfo('template_directory'); ?>/reources//images/profile.webp" alt="">
                        </div>                        
                    </div>

                    <div class="tab_wrapper">
        <?php page_title() ?>
    </div>

    


    <div class="custom_container catering_wrapper ">                       
                       
    
    <section id="div1" class="targetDiv activediv">

   

<div class="catering_card_wrapper">
            <div class="ajaxload"></div>
            <div class="foodlist">       
                <?php 
                        query_posts(array(
                            'post_type' => 'tickets',
                            'posts_per_page' => 1,
                            'order' => 'desc',  
                          
                        ) ); 

            
                if (have_posts()) :  while (have_posts()) : the_post();
                $date = get_field('date'); ?>
                        <div class="catering_card _pro_salat">
                            <h3>Modle  # <?php the_title() ?></h3>  

                            
                            

                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="mt-2">Priority:</h6>                                                                  
                                </div>
                                <div class="col-md-8">                               
                                    <?php $ticket_priority =  get_the_terms( $post->ID, 'ticket_priority' );                                     
                                    foreach($ticket_priority as $priority) {
                                        echo "<p>".$priority->name ."</p> " ;
                                    } ?>                               
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="mt-2">Type:</h6>                                                                  
                                </div>
                                <div class="col-md-8">                               
                                    <?php $ticket_type =  get_the_terms( $post->ID, 'ticket_type' );                                     
                                    foreach($ticket_type as $type) {
                                        echo "<p>".$type->name ."</p> " ;
                                    } ?>                               
                                </div>                        
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="mt-2">Status:</h6>                                                                  
                                </div>
                                <div class="col-md-8">                               
                                    <?php $ticket_status =  get_the_terms( $post->ID, 'ticket_status' );                                     
                                    foreach($ticket_status as $status) {
                                        echo "<p>".$status->name ."</p> " ;
                                    } ?>                               
                                </div>                        
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="mt-2">Category:</h6>                                                                  
                                </div>
                                <div class="col-md-8">                               
                                    <?php $ticket_cat =  get_the_terms( $post->ID, 'ticket_cat' );                                     
                                    foreach($ticket_cat as $cat) {
                                        echo "<p>".$cat->name ."</p> " ;
                                    } ?>                               
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="mt-2">Issues:</h6>                                                                  
                                </div>
                                <div class="col-md-8">                               
                                  <?php echo get_post_meta( $post->ID, 'issues', true ); ?>                               
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="mt-2">Technician Remarks:</h6>                                                                  
                                </div>
                                <div class="col-md-8">                               
                                  <?php echo get_post_meta( $post->ID, 'eng_remarks', true ); ?>                               
                                </div>                        
                            </div>

                            











                        </div>
                    <?php endwhile;
                    wp_reset_query();
                else : ?>
                   
                    <div class="catering_card _pro_salat">
                            <h3> 404 Not Found</h3>
                                             
                        </div>


                <?php endif; ?>
            </div>
            </div>
           
    </section>                
    <section id="div2" class="targetDiv">   
         <div class="catering_card_wrapper">
            <div class="ajaxload"></div>         
            </div> 
    </section>
    <section id="div3" class="targetDiv">
    <div class="catering_card_wrapper">
            <div class="ajaxload"></div>         
            </div> 
    </section>

    </div>

    </div>
    </div>
    </div>

    </main>

<?php get_footer(); ?>