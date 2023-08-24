                <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Ticket</th>
                            <th>Invoice Id</th>                         
                            <th>Agent</th>                         
                            <th>Order Date</th>                             
                            <th>Price</th>
                            <th>Status</th>
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

                        if (have_posts()) :  while (have_posts()) : the_post();
                                $i++;
                                $ticket_id = get_post_meta(get_the_ID(), 'order_id', true); 
                                $ticket_agent = get_post_meta($ticket_id, 'order_uid', true); 
                                $user_id = get_post_meta( $ticket_id, 'order_uid', true );
                                $user_info = get_userdata($user_id);                                                         
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo get_the_title($ticket_id);?></td>
                                    <td><?php the_title() ?></td> 
                                    <td><?php  echo  $user_info->user_login ?></td>                                  
                                    <td><?php  echo  get_the_modified_date(); ?></td>                          
                                    <td>$ <?php echo get_post_meta(get_the_ID(), 'order_price', true); ?></td>
                                    <td><span class="status <?php echo get_post_meta(get_the_ID(), 'order_status', true); ?>"><?php echo get_post_meta(get_the_ID(), 'order_status', true); ?> </span> </td>
                                </tr>
                            <?php endwhile;
                            wp_reset_query();
                        else : ?>
                            <h2><?php _e('Nothing Found', 'lbt_translate'); ?></h2>
                        <?php endif; ?>

                    </tbody>
