           
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
                                    if (!in_array('agent', $user_info->roles)) {   
                                        //wp_redirect( home_url('login'));                                                                         
                                        die("Not Allowed");                              
                                    }
                                    ?></h6>
                               </p>                            

                            </div>
                            <img src="<?php bloginfo('template_directory'); ?>/reources//images/profile.webp" alt="">
                        </div>                        
                    </div>