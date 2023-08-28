    <?php /* Template Name: Reports  */    get_header();

    echo "Reposts";



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


// Step 1: Read JSON Data from File
$json_data = file_get_contents(get_template_directory() . '/data.json');
$data_array = json_decode($json_data, true);

$records = $data_array['result']['records'];


if ($records) {

    foreach ($records as $array_data) {           

            $id = $array_data['id'];
            $stationid = $array_data['stationid'];
            $transformerid = $array_data['transformerid'];
            $transformername = $array_data['transformername'];
            $devid = $array_data['devid'];
            $devname = $array_data['devname'];
            $devnum  = $array_data['devnum'];
            $operdate = $array_data['operdate'];
            $qty_total = $array_data['qty_total'];
            $vol_a  = $array_data['vol_a'];
            $relay1state = $array_data['relay1state'];   
            $post_title = $stationid."-".$id;
          
            $post_data = array(
                'post_title' => $post_title,
                'post_content' => $stationid,
                'post_type' => 'records', // Change to your desired post type
                'post_status' => 'publish',
                'meta_input' => array(
                    'id' => $array_data['id'],
                    'stationid' => $array_data['stationid'],
                    'transformerid' => $array_data['transformerid'],
                    'transformername' => $array_data['transformername'],
                    'devid' => $array_data['devid'],
                    'devname' => $array_data['devname'],
                    'devnum' => $array_data['devnum'],
                    'operdate' => $array_data['operdate'],
                    'qty_total' => $array_data['qty_total'],
                    'vol_a' => $array_data['vol_a'],
                    'relay1state' => $array_data['relay1state'],
                )
            );

            // Insert the post with metadata
            $post_id = wp_insert_post($post_data);
            echo "Post inserted with ID: " . $post_id . "<br>";

            if (is_wp_error($post_id)) {
                echo "Error inserting post: " . $post_id->get_error_message();
            } else {
                echo "Post inserted with ID: " . $post_id . "<br>";
            }
          

    


         

       

            
       
        
           

    
    }
}














    ?>

<?php get_footer()?>