                <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Ticket</th>
                            <th>Invoice Id</th>                         
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
                                    <td><?php echo get_the_title($ticket_id);?></td>
                                    <td><?php the_title() ?></td> 
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
