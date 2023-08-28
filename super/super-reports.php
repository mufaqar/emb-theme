<?php /* Template Name: Reports */    get_header('admin');


?>
    <?php include('navigation.php'); ?>
    <div class="admin_parrent">
        <!-- <div class="toggle_btn">
            <div class="row ">
                <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                    <div class="catering_menu buttons">
                    <a id="1" class="showSingle _active" target="1" data="">All</a>
                    <a id="2" class="showSingle" target="2" data="Complete">Complete</a>
                    <a id="3" class="showSingle" target="3" data="Pending">Pending</a>
                    <a id="5" class="showSingle" target="5" data="Partials">Partials</a>
                    <a id="4" class="showSingle" target="4" data="Cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </div> -->
        <section id="div1" class="targetDiv activediv tablediv">
        <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
        <thead>
                    <tr>
                        <th>Sr #</th> 
                        <th>Dev Name</th>       
                        <th>Oper date</th>
                        <th>QTY</th>
                        <th>Vol A</th>
                     
                    </tr>
                </thead>
                <tbody>

                <?php 
                    $i = 0;
                    query_posts(array(
                        'post_type' => 'records',
                        'posts_per_page' => -1,
                        'order' => 'desc'
                    ));

                    if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                            $i++;
                            $id = get_post_meta(get_the_ID(),'id', true); 
                            $stationid = get_post_meta(get_the_ID(),'stationid', true); 
                            $transformerid = get_post_meta(get_the_ID(),'transformerid', true); 
                            $transformername = get_post_meta(get_the_ID(),'transformername', true); 
                            $devid = get_post_meta(get_the_ID(),'devid', true); 
                            $devname = get_post_meta(get_the_ID(),'devname', true); 
                            $devnum  = get_post_meta(get_the_ID(),'devnum', true); 
                            $operdate = get_post_meta(get_the_ID(),'operdate', true); 
                            $qty_total = get_post_meta(get_the_ID(),'qty_total', true); 
                            $vol_a  = get_post_meta(get_the_ID(),'vol_a', true); 
                            $relay1state = get_post_meta(get_the_ID(),'relay1state', true);    
                            
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php  echo $devname ?></td>   
                                <td><?php  echo $operdate ?></td>   
                                <td><?php  echo $qty_total ?></td>   
                                <td><?php  echo $vol_a ?></td>   
                                                     
                             
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