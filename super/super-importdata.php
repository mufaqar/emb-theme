    <?php /* Template Name: ImportData */    get_header();

  //  echo "Reposts";


    // $allposts= get_posts( array('post_type'=>'records','numberposts'=>-1) );
    //     foreach ($allposts as $eachpost) {
    //     wp_delete_post( $eachpost->ID, true );
    //     }

//exit();

   $token =  Is_Token_Expired(); 

   // echo $token;
    

    $url = 'https://saven.jcen.cn/pwsys/pwtransiot/pwTransIot/list_data';
    $startDate = '2023-08-13';
    $endDate = '2023-09-11';
    $args = array(
        'body' => json_encode(array(
            'startTime' => $startDate,
            'endTime' => $endDate,
            'pageNo' => 1,
            'pageSize' => 1000,
        )),
        'headers' => array(
            'X-Access-Token' => $token,
            'Content-Type' => 'application/json',
        ),
        'method' => 'POST',
        'sslverify' => false,
        'timeout' => 180 
    );
    
    $response = wp_remote_post($url, $args);

 

    if ( is_wp_error( $response ) ) {
        // Handle the error, if any
    } else {
        $body = wp_remote_retrieve_body( $response );

    }
    

    $data = json_decode($body);

    // Access the "records" array
    $records = $data->result->records;
  

   //print "<pre>";
 //  print_r($records);




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
            $power_a = $array_data['power_a']; 
            $amp_a = $array_data['amp_a'];   
            
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
                    'power_a' => $array_data['power_a'],
                    'amp_a' => $array_data['amp_a'],

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