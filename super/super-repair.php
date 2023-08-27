    <?php /* Template Name: Reports  */    get_header();


$curl = curl_init();




curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sav.jcen.cn/pwsys/sys/gettoken',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"appid":"shabbir",
"appsecret":"shabbir-123",
"code":"892894b98ceb5f11660d6cd3fff5c3d1"
}

',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


echo "Working fine";


    ?>

<?php get_footer()?>