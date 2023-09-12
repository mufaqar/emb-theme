 <main class="launch_calandar">
        <div class="row d-flex">
            <div class="" style="width: 230px;">           
                <div class="sidebar p-0 align-items-start pt-5">
                    <div class="d-flex justify-content-center">
                       <a href="<?php bloginfo('url'); ?>"> <img src="<?php bloginfo('template_directory'); ?>/reources//images/logo.png" class="logo" alt=""></a>
                    </div>                   
                    <div class="mt-5">                        
                        <?php 	
                                if (current_user_can('administrator')) {
                                    wp_nav_menu ( array(
                                        'container'       => false,	
                                        'theme_location'  => 'super',	
                                        'menu_class'      => 'myProfileNav activeNav'									
                                    ) );                                  
                                    
                                }  else {
                                    // Default menu for other users
                                    wp_nav_menu ( array(
                                        'container'       => false,	
                                        'theme_location'  => 'company',	
                                        'menu_class'      => 'myProfileNav activeNav'									
                                        ) ); 
                                }





								?>       
                            
                        

                    </div>
                    <div class="logout">                       	
                    <a href="<?php echo wp_logout_url( home_url() ); ?>"> <img src="<?php bloginfo('template_directory'); ?>/reources/images/logout.png" alt=""><span>Log Out</span></a>
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
                            <h6><?php   $user = wp_get_current_user();  
                                 if ( is_user_logged_in() ) { 
                                    echo 'Hey, ' .  $user->display_name ."<br/>" ; } 
                                    else {
                                        wp_redirect( home_url('login'));                                     
                                        exit;
                                    }                               
                           
                                    $user_info = get_userdata($user->ID);                                   
                                    $role = $user_info->roles;
                                    echo $role[0];               
                                    $desired_roles = array('administrator', 'company');
                                    if (array_intersect($desired_roles, $user->roles)) {
                                        // The user has one of the desired roles (admin or company)                                
                                    } else {
                                        // User doesn't have the desired roles, display a default menu
                                        }
                                   
                                    ?></h6>  
                            </div>
                            <img src="<?php bloginfo('template_directory'); ?>/reources//images/profile.webp" alt="">
                        </div>                        
                    </div>