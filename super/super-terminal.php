<?php /* Template Name: Terminal Manager  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">

    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2>Terminal</h2>
                    <div><a href="<?php echo home_url('dashboard/add-terminal'); ?>"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    <th>Edit</th>



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