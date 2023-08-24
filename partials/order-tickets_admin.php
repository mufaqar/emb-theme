<?php
global $current_user; wp_get_current_user();  $uid = $current_user->ID;

?>


<thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Model</th>                                         
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                        $i = 0;

                        query_posts(array(
                            'post_type' => 'tickets',
                            'posts_per_page' => -1,
                            'order' => 'desc',
                            
                        ));

                        if (have_posts()) :  while (have_posts()) : the_post(); $pid = get_the_ID(); $i++; ?>
                                 <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $pid?></td>                                                
                                                <td><?php echo get_post_meta( get_the_ID(), 'date', true ); ?> </td>
                                                <td><?php the_title(); ?></td>
                                                                                      
                                                <td><?php echo get_post_meta( get_the_ID(), 'price', true ); ?></td>
                                                <td><?php   
                                                        $term_list = get_the_terms($post->ID, 'ticket_type');
                                                        $types ='';
                                                        foreach($term_list as $term_single) {
                                                            $types .= ucfirst($term_single->slug).', ';
                                                        }
                                                        $typesz = rtrim($types, ', ');
                                                        echo $typesz;                                                    
                                                     ?>
                                                </td>
                                                <td> <a href="<?php echo home_url('edit-ticket?id='.$pid.''); ?>">Edit </a>  <i class="fa-solid fa-down-to-line"></i></td>
                                                </tr>
                            <?php endwhile;
                            wp_reset_query();
                        else : ?>
                            <h2><?php _e('Nothing Found', 'lbt_translate'); ?></h2>
                        <?php endif; ?>

                    </tbody>
