    <?php /* Template Name: ImportData */    get_header();

 

$token = Is_Token_Expired();

if (!$token) {
    echo "Error getting the access token.";
} else {
    $url = 'https://saven.jcen.cn/pwsys/pwtransiot/pwTransIot/list_data';

    // Set the start and end times (using the correct date format)
    $start_time = "2023-10-08";
    $end_time = "2023-10-10";

  

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
        'timeout' => 280
    );

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        echo "Error sending the API request: " . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        if (empty($data->result->records)) {
            echo "No records found in the API response.";
        } else {
            $records = $data->result->records;

            foreach ($records as $array_data) {
                // Extract data from the API response
                $id = $array_data->id;
                $stationid = $array_data->stationid;
                $transformerid = $array_data->transformerid;
                // Add more fields as needed...

                // Create a post title
                $post_title = $stationid . "-" . $id;

                // Create post content and metadata array
                $post_content = $stationid;
                $meta_input = array(
                    'id' => $id,
                    'stationid' => $stationid,
                    'transformerid' => $transformerid,
                    // Add more metadata fields as needed...
                );

                // Insert the post with metadata
                $post_data = array(
                    'post_title' => $post_title,
                    'post_content' => $post_content,
                    'post_type' => 'records',
                    'post_status' => 'publish',
                    'meta_input' => $meta_input,
                );

                $post_id = wp_insert_post($post_data);

                if (is_wp_error($post_id)) {
                    echo "Error inserting post: " . $post_id->get_error_message();
                } else {
                    echo "Post inserted with ID: " . $post_id . "<br>";
                }
            }
        }
    }
}














    ?>

    <?php get_footer()?>