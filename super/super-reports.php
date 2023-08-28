<?php /* Template Name: Reports */    get_header('admin');


?>
    <?php include('navigation.php'); ?>
    <div class="admin_parrent">
        <div class="toggle_btn">
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
        </div>
        <section id="div1" class="targetDiv activediv tablediv">
        <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
        <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>Invoice Id</th>   
                        <th>Ticket</th>
                        <th>Model</th>
                        <th>Agent</th>                         
                        <th>Order Date</th>                             
                        <th>Price</th>
                        <th>Amout Paid</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                    $i = 0;
                    query_posts(array(
                        'post_type' => 'orders',
                        'posts_per_page' => -1,
                        'order' => 'desc'
                    ));

                    if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                            $i++;
                            $ticket_id = get_post_meta(get_the_ID(), 'order_id', true); 
                            $ticket_agent = get_post_meta($ticket_id, 'order_uid', true); 
                            $user_id = get_post_meta( $ticket_id, 'order_uid', true );
                            $user_info = get_userdata($user_id);  
                            $cat_status  = get_the_terms( $pid, 'order_status');
                            foreach($cat_status as $cat_selected)
                            {
                              $cat_active =  $cat_selected->slug;
                              $cat_name =  $cat_selected->name;
                            }  
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php the_title() ?></td> 
                                <td><?php echo $ticket_id;?></td>
                                <td><?php echo get_the_title($ticket_id);?></td>
                                <td><?php  echo  $user_info->user_login ?></td>                                  
                                <td><?php  echo  get_the_modified_date(); ?></td>                          
                                <td>$ <?php echo get_post_meta(get_the_ID(), 'order_price', true); ?></td>
                                <td>$ <?php echo get_post_meta(get_the_ID(), 'order_price_paid', true); ?></td>
                                <td><span class="status <?php  echo $cat_active ?>"><?php echo $cat_name ?> </span> </td>
                                <td> <a href="<?php echo home_url('admin-dashboard/edit-invoice?id='.$pid.''); ?>">Edit </a>  <i class="fa-solid fa-down-to-line"></i></td>
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