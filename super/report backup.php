    <?php /* Template Name: Reports  */    get_header();



// $url = 'https://sav.jcen.cn/pwsys/sys/gettoken';
// $args = array(
//     'body' => json_encode(array(
//         'appid' => 'shabbir',
//         'appsecret' => 'shabbir-123',
//         'code' => '892894b98ceb5f11660d6cd3fff5c3d1',
//     )),
//     'headers' => array(
//         'Content-Type' => 'application/json',
//     ),
//     'method' => 'POST',
//     'sslverify' => false, // Set to true to enable SSL verification
// );

// $response = wp_remote_request($url, $args);

// if (is_array($response) && !is_wp_error($response)) {
//     $body = wp_remote_retrieve_body($response);
//     // Process $body as needed
// }


//'startTime' =>'2023-08-25',
//'endTime'  => '2023-08-26',


$url = 'https://sav.jcen.cn/pwsys/pwtransiot/pwTransIot/list_xzairport';

$args = array(
    'body' => json_encode(array(
        'meterNum' => '230729010001',       
        'pageSize' => 1000,
        'pageNo' => 1,
    )),
    'headers' => array(
        'X-Access-Token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2OTMyMTEzOTYsInVzZXJuYW1lIjoic2hhYmJpciJ9.QU5Pm8lnuKY8pI-tJbaZB_xjmM4iifrp537OXvcPc-c',
        'Content-Type' => 'application/json',
    ),
    'method' => 'POST',
    'sslverify' => false
);

$response = wp_remote_post($url, $args);
if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

     print "<pre>";
     print_r($data);

  

    if (is_array($data) && isset($data['result']) && is_array($data['result'])) {
        foreach ($data['result'] as $record) {  
            
            print_r($record);

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

            echo $stationid;

        }

            
           echo "post inserted";
     

           //echo $record['stationid'];
        
           

    
    }
}














    ?>

<?php get_footer()?>