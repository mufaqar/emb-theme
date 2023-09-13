    <?php /* Template Name: ImportData */    get_header();

  //  echo "Reposts";


    

   $token =  Is_Token_Expired(); 

   // echo $token;

   $start_time = date('Y-m-d H:i:s', strtotime('+45 minutes'));
   $end_time = date('Y-m-d H:i:s', strtotime('+75 minutes'));

   echo $start_time;

   echo "<hr/>";

   echo $end_time;

   //die();
    

    $url = 'https://saven.jcen.cn/pwsys/pwtransiot/pwTransIot/list_data';
     // Set the start and end times (30 minutes from now)
    $start_time = "2023-08-14 01:30";
    $end_time =  $end_time ;
    $args = array(
        'body' => json_encode(array(
            'startTime' => $start_time,
            'endTime' => $end_time,
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
         $data = json_decode($body);
        // Access the "records" array
        $records = $data->result->records;

        if (is_wp_error($response)) {
            // Handle the error, if any
        } else {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body);
        
            // Access the "records" array
            $records = $data->result->records;        
            foreach ($records as $array_data) {
                $id = $array_data->id;
                $stationid = $array_data->stationid;
                $transformerid = $array_data->transformerid;
                $transformername = $array_data->transformername;
                $devid = $array_data->devid;
                $devname = $array_data->devname;
                $devnum  = $array_data->devnum;
                $operdate = $array_data->operdate;
                $qty_total = $array_data->qty_total;
                $vol_a  = $array_data->vol_a;
                $relay1state = $array_data->relay1state;
                $power_a = $array_data->power_a;
                $amp_a = $array_data->amp_a;
                $post_title = $stationid . "-" . $id;
                $post_data = array(
                    'post_title' => $post_title,
                    'post_content' => $stationid,
                    'post_type' => 'records', 
                    'post_status' => 'publish',
                    'meta_input' => array(
                        'id' => $id,
                        'stationid' => $stationid,
                        'transformerid' => $transformerid,
                        'transformername' => $transformername,
                        'devid' => $devid,
                        'devname' => $devname,
                        'devnum' => $devnum,
                        'operdate' => $operdate,
                        'qty_total' => $qty_total,
                        'vol_a' => $vol_a,
                        'relay1state' => $relay1state,
                        'power_a' => $power_a,
                        'amp_a' => $amp_a,
                    )
                );
        
                // Insert the post with metadata
                $post_id = wp_insert_post($post_data);
                if (is_wp_error($post_id)) {
                    echo "Error inserting post: " . $post_id->get_error_message();
                } else {
                    echo "Post inserted with ID: " . $post_id . "<br>";
                }
            }
        }
        

    }














    ?>

    <?php get_footer()?>