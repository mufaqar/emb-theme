<?php /* Template Name: Company-RemoteManager  */
get_header('admin');
$user = wp_get_current_user();  
$UID = $user->ID;


?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">
    <section id="div1" class="targetDiv activediv tablediv">

    <table id="allusers" class="table table-striped orders_table export_table" style="width:100%">
            <thead>
                <tr>
                    <th>Sr #</th>                   
                    <th>Devnum </th>
                    <th>Dev Name </th>
                    <th>company  </th>               
                    <th>branch  </th>
                    <th>floor section  </th>                   
                    <th>Status</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>

                <?php
                  $i = 0;
                  query_posts(array(
                      'post_type' => 'terminals',
                      'posts_per_page' => -1,
                      'order' => 'desc',
                      'meta_query' => array(
                        array(
                            'key' => 'terminal_company', 
                            'value' => $UID, 
                            'compare' => '=',
                        ),
                    ),
                  ));

                  if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                    $i++; 
                    $terminal_devnum = get_post_meta($pid , 'terminal_devnum', true);
                    $terminal_devname = get_post_meta($pid , 'terminal_devname', true);
                    $terminal_company = get_post_meta($pid , 'terminal_company', true);                    
                    $terminal_branch_name = get_post_meta($pid , 'terminal_branch_name', true);
                    $terminal_floor_section = get_post_meta($pid , 'terminal_floor_section', true);

                    $user_info = get_userdata($terminal_company);                  
                    $terminal_status = get_post_meta($pid , 'dev_status', true);
                    $checked_status = ($terminal_status == 'On') ? 'checked' : '';
                    
                      ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <th><?php the_title()?></th>
                    <th><?php echo $terminal_devname?></th>
                    <th><?php echo $user_info->name?></th>          
                    <th><?php echo $terminal_branch_name?></th>
                    <th><?php echo $terminal_floor_section ?></th>
                    <th><?php echo $terminal_status ?></th>
                    <th>
                    <label class="switch" data-id="<?php echo $terminal_devnum ?>" data-pid="<?php echo $pid ?>" >
                    <input type="checkbox" class="id-toggle"  <?php echo $checked_status ?> >
                    <span class="slider round"></span>
                    </label>     
                    </th>
                </tr>
                <?php endwhile;
                        wp_reset_query();
                    else : ?>
                <h2><?php _e('Nothing Found', 'lbt_translate'); ?></h2>
                <?php endif; ?>

            </tbody>

        </table>

    </section>

</div>





<?php get_footer('admin') ?>
     <!-- Font Awsome -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">   
    jQuery(document).ready(function($) {
    $('.id-toggle').on('change', function () {
        const id = $(this).closest('.switch').attr('data-id');
        const pid = $(this).closest('.switch').attr('data-pid');
        
        const isChecked = $(this).is(':checked');

        
        if (isChecked) {
            $.ajax({
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                type: 'POST',
                data: {
                    action: "switch_on",
                    id: id,
                    pid : pid
                },
                success: function (response) {
                    // Handle the success response here
                    alert('Device is ON');
                },
                error: function (error) {
                    // Handle the error here
                    console.error('Error:', error);
                }
            });
        } else {
         
            // If the toggle is turned off, make an AJAX call for "off" action
            $.ajax({
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                type: 'POST',
                data: {
                    action: "switch_off",
                    id: id,
                    pid : pid
                },
                success: function (response) {
                   
                    alert('Device is OFF');
                },
                error: function (error) {
                    // Handle the error here
                    console.error('Error:', error);
                }
            });
        }
    });
});

	</script>















   