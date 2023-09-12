<?php /* Template Name: API-Reports */    get_header('admin');
// $token =  Is_Token_Expired(); 

// echo $token;

// //echo $token;
// $url = 'https://saven.jcen.cn/pwsys/pwtransiot/pwTransIot/list_data';
// $startDate = '2023-08-13';
// $endDate = '2023-09-11';
// $args = array(
//     'body' => json_encode(array(
//         'startTime' => $startDate,
//         'endTime' => $endDate,
//         'pageNo' => 1,
//         'pageSize' => 1000,
//     )),
//     'headers' => array(
//         'X-Access-Token' => $token,
//         'Content-Type' => 'application/json',
//     ),
//     'method' => 'POST',
//     'sslverify' => false,
//     'timeout' => 180 
// );

// $response = wp_remote_post($url, $args);

// print_r($response)

?>
    <?php include('navigation.php'); ?>
    <div class="admin_parrent">        
        <section id="div1" class="targetDiv activediv tablediv">
        <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
        <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>Device Number</th>                         
                        <th>Device Name</th>                             
                        <th>Operation Date</th>
                        <th>Quanity</th>
                        <th>Volts</th>
                        <th>Status </th> 
                     
                    </tr>
                </thead>
                <tbody>

                <?php 

                        $i = 0;
                        query_posts(array(
                            'post_type' => 'records',
                            'posts_per_page' => 10,
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