    <?php /* Template Name: Reports  */    get_header('admin');


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



exit;













curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sav.jcen.cn/pwsys/pwtransiot/pwTransIot/list_xzairport',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSL_VERIFYPEER => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "meterNum": "230729010001",
    "pageSize": 1000,
    "pageNo": 1000
}
',
  CURLOPT_HTTPHEADER => array(
    'X-Access-Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2OTMxMjk4MDksInVzZXJuYW1lIjoic2hhYmJpciJ9.tyWyts9IYxfGgRgeeQ-C92X-HZE-Y_ObgLXQ-V3PykA',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
echo "123456"


    ?>

<?php get_footer('admin') ?>