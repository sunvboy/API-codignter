<?php
//$curl = curl_init('https://dev.ghtk.vn/authentication-request-sample');
//
////curl_setopt_array($curl, array(
////    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
////    CURLOPT_RETURNTRANSFER => true,
////    CURLOPT_HTTPHEADER => array(
////        "Token: 0913e10577E2572edf112d44159a9C9C24123b7a",
////    ),
////));
////
////$response = curl_exec($curl);
////curl_close($curl);
////echo 'Response: ' . $response;
//
//
//$ch = $curl;
//curl_setopt($ch, CURLOPT_POST, TRUE);
//curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=UTF-8,Token: 0913e10577E2572edf112d44159a9C9C24123b7a'));
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$result = curl_exec($ch);
//curl_close($ch);
//echo 'Response: ' . $result;
//?>

<?php
$data = array(
    "pick_province" => "Hà Nội",
    "pick_district" => "Quận Hai Bà Trưng",
    "province" => "Hà nội",
    "district" => "Quận Cầu Giấy",
    "address" => "P.503 tòa nhà Auu Việt, số 1 Lê Đức Thọ",
    "weight" => 10000,
    "value" => 3000000,
    "transport" => "fly"
);
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        "Token: 0913e10577E2572edf112d44159a9C9C24123b7a",
    ),
));

$response = curl_exec($curl);
curl_close($curl);

echo "<pre>";var_dump($response);die;
?>


