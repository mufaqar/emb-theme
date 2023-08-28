<?php /* Template Name: Floor Planner  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">

    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2>Location</h2>
                    <div><a href="<?php echo home_url('dashboard/add-location'); ?>"><i class="fa-solid fa-plus"></i></a>
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
                    <th>Location</th>                  
                    <th>Status</th>
                 
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>

                <?php
            
                $i = 0;
                query_posts(array(
                    'post_type' => 'records',
                    'posts_per_page' => 5,
                    'order' => 'desc'
                ));

                if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();$i++
                      ?>
                <tr>
                    <td class="pt-4"><?php echo $i ?></td>
                    <td class="">
                        <?php echo the_title() ?></td>
                     
               
                    <td>Active</td>
                    <td>Update</td>

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