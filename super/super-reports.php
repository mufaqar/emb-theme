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


$url = 'https://sav.jcen.cn/pwsys/pwtransiot/pwTransIot/list_xzairport';

$args = array(
    'body' => json_encode(array(
        'meterNum' => '230729010001',
        'pageSize' => 1000,
        'pageNo' => 1,
    )),
    'headers' => array(
        'X-Access-Token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2OTMxMzExODIsInVzZXJuYW1lIjoic2hhYmJpciJ9.EaHxm_aKHCD-TNgat50iXSnFznIdIW9hAsqjdNoPvW0',
        'Content-Type' => 'application/json',
    ),
    'method' => 'POST',
    'sslverify' => false
);

$response = wp_remote_post($url, $args);




if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (is_array($data) && isset($data['result']) && is_array($data['result'])) {
        foreach ($data['result'] as $record) {

            print_r($record);
            // Create a new post
            // $post_id = wp_insert_post(array(
            //     'post_type' => 'your_custom_post_type', // Replace with your custom post type slug
            //     'post_title' => $record['title'], // Change this to the appropriate title field
            //     'post_content' => $record['content'], // Change this to the appropriate content field
            //     'post_status' => 'publish',
            // ));

            // Add custom metadata
          //  update_post_meta($post_id, 'custom_meta_key_1', $record['meta_value_1']);
         //   update_post_meta($post_id, 'custom_meta_key_2', $record['meta_value_2']);
            // Add more meta fields as needed
        }
    }
}














    ?>

<?php get_footer()?>