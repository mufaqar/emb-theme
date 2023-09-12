<?php /* Template Name: Branch Manager  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">

    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2>Branch</h2>
                    <div><a href="<?php echo home_url('admin-dashboard/add-branch'); ?>"><i class="fa-solid fa-plus"></i></a>
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
                    <th>Branch Name</th>
                    <th>Company Name</th>
                    <th>Location Code</th>               
                    <th>Country</th>
                    <th>Status</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>

                <?php
                  $i = 0;
                  query_posts(array(
                      'post_type' => 'branch',
                      'posts_per_page' => -1,
                      'order' => 'desc'
                  ));

                  if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                    $i++; 
                    $branch_address = get_post_meta($pid , 'branch_address', true);
                    $branch_code = get_post_meta($pid , 'branch_code', true);
                    $branch_company = get_post_meta($pid , 'branch_company', true);                    
                    $branch_country = get_post_meta($pid , 'branch_country', true);
                    $post_status = get_post_status($pid);
                 
                        if ($post_status === 'publish') {
                            $text_status = 'Active';
                        } else {
                            $text_status = 'Inactive';  
                        }

                        $user_info = get_userdata($branch_company);

                    
                      ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <th><?php the_title()?></th>
                    <th><?php echo $user_info->name?></th>
                    <th><?php echo $branch_code?></th>                
                    <th><?php echo $branch_country?></th>
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