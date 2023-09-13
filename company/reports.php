<?php /* Template Name: Company-Reports */    get_header('admin');
$user = wp_get_current_user();  
$UID = $user->ID;

?>
    <?php include('navigation.php'); ?>
    <div class="tab_heading">
       <h1> <h2> Report By Branches </h2></h1>
    </div>
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

        <div class="row ">
                <div class="catering_wrapper mb-5 col-md-8">
                    
                    <div class="catering_menu buttons">                   

                        <?php 

                    $args = array(
                        'post_type' => 'branch', 
                        'posts_per_page' => -1, 
                        'meta_query' => array(
                            array(
                                'key' => 'branch_company', 
                                'value' => $UID, 
                                'compare' => '=',
                            ),
                        ),
                    );
                    $custom_query = new WP_Query($args); 

             

// Check if there are posts
$s = 0;
if ($custom_query->have_posts()) { 
    while ($custom_query->have_posts()) { $s++; $custom_query->the_post();
        ?> <a id="<?php echo $s ?>" class="showSingle" target="<?php echo $s ?>" data="<?php echo get_the_ID()?>" data-title="<?php echo get_the_ID()?>"><?php echo get_the_title() ?></a> <?php
    }

    // Restore the global post object to its original state
    wp_reset_postdata();
} else {
    // No posts found
    echo 'No branches found.';
}

                    ?>
                    </div>
                </div>
            </div>
        <section id="div1" class="targetDiv activediv tablediv">
        <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
        <thead>
                    <tr>
                        <th>Sr #</th>                 
                        <th>Station Id</th>
                        <th>Transformer Id</th>
                        <th>Dev Id</th>                         
                        <th>Dev Name</th>                             
                        <th>Oper date</th>
                        <th>QTY</th>
                        <th>Vol A</th>
                     
                    </tr>
                </thead>
                <tbody>

                <?php 
                $result = get_terminal_info($UID);
             
                $terminal_list = $result['terminal_titles'];

                        foreach ($terminal_list as $dev_value) {
                            $meta_query[] = array(
                                'key' => 'devnum',
                                'value' => $dev_value,
                                'compare' => '=',
                            );
                        }                  
                        if (count($meta_query) > 1) {                
                            $meta_query['relation'] = 'OR';
                        }
                                            $i = 0;
                    query_posts(array(
                        'post_type' => 'records',
                        'posts_per_page' => -1,
                        'order' => 'desc',
                        'meta_query' => $meta_query
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
                                <td><?php echo $stationid;?></td>
                                <td><?php echo $transformerid?></td>
                                <td><?php  echo $devid ?></td>                                  
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>  




jQuery(document).ready(function($) 
        {  

jQuery('.showSingle').click(function() {
           var cat_name = $(this).attr('data');  
          // alert(cat_name);
        });

           

});

   
</script>