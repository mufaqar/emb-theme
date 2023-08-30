<?php /* Template Name: AddTerminal */ 
get_header();

?> 
 <?php include('navigation.php'); ?>
 <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;?>

<div class="custom_container catering_form mt-5 mb-5">
    <div class="_info mt-5 mb-3">
        <h2>Create Terminal  </h2>
    </div>
    <div class="_form p-4 pt-5 pb-5">
    <form class="add_ticket" id="add_ticket" action="#" enctype="multipart/form-data">
            <div class="row">
            
                <div class="col-md-6 mb-3">
                    <label for="">Dev Number </label>
                    <div class="_select">
                        <input type="text" value="" placeholder="Please enter Dev Number" id="devnum" required>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="">Dev Name </label>
                    <div class="_select">
                        <input type="text" value="" placeholder="Please enter Dev name" id="devname" required>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="">Company </label>
                    <div class="_select">
                        <?php            
                        $users = get_users( array(
                            'role' => 'company',
                        ) );
                        ?>
                        <select name="user_select"  id="company">
                            <?php foreach ( $users as $user ) : ?>
                                <option value="<?php echo esc_attr( $user->ID ); ?>">
                                    <?php echo esc_html( $user->display_name ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="">Branch Name</label>
                    <div class="_select">
                        <?php            
                        $args = array(
                            'post_type' => 'branch',  
                            'posts_per_page' => -1, 
                        );                    
                        $posts = get_posts($args);
                        ?>
                        <select name="user_select"  id="branch_name">
                            <?php foreach ($posts as $post)  : ?>
                                <option value="<?php echo esc_attr( $post->post_title ); ?>">
                                    <?php echo esc_html( $post->post_title ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>  

                 <div class="col-md-6 mt-3 mt-md-0 mb-3">
                    <label for="">Floor Section</label>
                    <div class="_select">
                        <?php            
                       $terms = get_terms(array(
                        'taxonomy' => 'location',
                        'hide_empty' => false, 
                    ));
                        ?>
                        <select name="user_select"  id="floor_section">
                            <?php  foreach ($terms as $term)  : ?>
                                <option value="<?php echo esc_attr( $term->name); ?>">
                                    <?php echo  $term->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>     
                <div class="d-flex justify-content-end savebtn">
                    <input type="submit" class="btn_primary"  value="Add Terminal"/>
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
                            <h2 class="mb-5 mt-5">We Have Create Terimianl For you</h2>
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
            var devnum = jQuery('#devnum').val();	
            var devname = jQuery('#devname').val();	  
            var company = jQuery('#company').val();	
            var branch_name = jQuery('#branch_name').val();	
            var floor_section = jQuery('#floor_section').val();	
       
            form_data = new FormData();   
            form_data.append('action', 'add_terminal');
            form_data.append('devnum', devnum);
            form_data.append('devname', devname);
            form_data.append('company', company);
            form_data.append('branch_name', branch_name); 
            form_data.append('floor_section', floor_section);  
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













