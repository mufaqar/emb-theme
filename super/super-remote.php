<?php /* Template Name: Remote Manager  */
get_header('admin');
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
                      'order' => 'desc'
                  ));

                  if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                    $i++; 
                    $terminal_devnum = get_post_meta($pid , 'terminal_devnum', true);
                    $terminal_devname = get_post_meta($pid , 'terminal_devname', true);
                    $terminal_company = get_post_meta($pid , 'terminal_company', true);                    
                    $terminal_branch_name = get_post_meta($pid , 'terminal_branch_name', true);
                    $terminal_floor_section = get_post_meta($pid , 'terminal_floor_section', true);

                    $user_info = get_userdata($terminal_company);

                  
                    $post_status = get_post_status($pid);                 
                        if ($post_status === 'publish') {
                            $text_status = 'Active';
                        } else {
                            $text_status = 'Inactive';  
                        }
                    
                      ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <th><?php the_title()?></th>
                    <th><?php echo $terminal_devname?></th>
                    <th><?php echo $user_info->name?></th>          
                    <th><?php echo $terminal_branch_name?></th>
                    <th><?php echo $terminal_floor_section ?></th>
                    <th><?php echo $text_status ?></th>
                    <th><div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="onOffSwitch">
  <label class="custom-control-label" for="onOffSwitch">On/Off</label>
</div></th>



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
