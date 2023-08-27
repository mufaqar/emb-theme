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

print_r($response);

if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    echo $body;
}




print_r($response);















    ?>

<?php get_footer()?>