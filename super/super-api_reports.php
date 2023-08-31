<?php /* Template Name: API-Reports */    get_header('admin');
$token =  Is_Token_Expired(); 

//echo $token;
$url = 'https://sav.jcen.cn/pwsys/pwtransiot/pwTransIot/list_xzairport';
$args = array(
    'body' => json_encode(array(
        'startTime' => '2023-08-20',       
        'endTime' => "2023-08-30",
        'pageNo' => 1,
        'pageSize' => 1000,
    )),
    'headers' => array(
        'X-Access-Token' => $token,
        'Content-Type' => 'application/json',
    ),
    'method' => 'POST',
    'sslverify' => false
);

$response = wp_remote_post($url, $args);
?>
    <?php include('navigation.php'); ?>
    <div class="admin_parrent">        
        <section id="div1" class="targetDiv activediv tablediv">
        <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
        <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>Dev Id</th>                         
                        <th>Dev Name</th>                             
                        <th>Oper date</th>
                        <th>QTY</th>
                        <th>Vol A</th>
                        <th>Status </th> 
                     
                    </tr>
                </thead>
                <tbody>

                <?php 

if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);   
     foreach ($data['result']['records'] as $record) {  
        

          
                            $i = 0;
                   
                            $i++;
                            $id = $record['id'];
                            $stationid = $record['stationid'];
                            $transformerid = $record['transformerid'];
                            $transformername = $record['transformername'];
                            $devid = $record['devid'];
                            $devname = $record['devname'];
                            $devnum  = $record['devnum'];
                            $operdate = $record['operdate'];
                            $qty_total = $record['qty_total'];
                            $vol_a  = $record['vol_a'];
                            $relay1state = $record['relay1state'];
                            
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>   
                                <td><?php  echo $devid ?></td>                                  
                                <td><?php  echo $devname ?></td>   
                                <td><?php  echo $operdate ?></td>   
                                <td><?php  echo $qty_total ?></td>   
                                <td><?php  echo $vol_a ?></td>   
                                <td><?php  echo $relay1state ?></td>   
                                                     
                             
                            </tr>
                        <?php  } } ?>

                </tbody>

               

            </table>

        </section>

    </div>




<?php get_footer('admin') ?>