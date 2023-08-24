    <?php /* Template Name: Super-Repair_List  */    get_header('admin');


    ?>
    <style>

#div1 { width: 90% !important;margin: 0px auto;}

</style>
        <?php include('navigation.php'); ?>
        <div class="admin_parrent">
            
            <section id="div1" class="targetDiv activediv tablediv">
            <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
            <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Model</th>
                            <th>Fault Type</th>                         
                            <th>Type</th>                             
                            <th>Parts availbiility</th>
                           
                         
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                        $i = 0;
                        query_posts(array(
                            'post_type' => 'repair',
                            'posts_per_page' => -1,
                            'order' => 'desc'
                        ));

                        if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                                $i++;
                                $diagnostic_fee = get_post_meta(get_the_ID(), 'diagnostic_fee', true); 
                                $parts_availablity = get_post_meta($pid, 'parts_availablity', true);                                 
                                $repair_cost = get_post_meta( $pid, 'repair_cost', true );                             
                                $cat_status  = get_the_terms( $pid, 'cat_fault_type');
                                foreach($cat_status as $cat_selected)
                                {
                             
                                  $cat_name =  $cat_selected->name;
                                }
                                
                                $repair_cats  = get_the_terms( $pid, 'repair_cat');
                                foreach($repair_cats as $repair_cat)
                                {
                          
                                  $repair_cat_name =  $repair_cat->name;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php the_title() ?></td> 
                                    <td><?php echo $cat_name;?></td>
                                    <td><?php echo $repair_cat_name;?></td>
                                    <td><?php echo $parts_availablity;?></td>                                                            
                                   
                                   
                                
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