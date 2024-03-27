<?php


function secondVisit_form($entityData) {

include('config.inc.php');
$conn = mysqli_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
$query = "SELECT * FROM middleware"; 
$result = $conn->query($query);
$row = $result->fetch_assoc();
$middlewareurl = $row['middlewareurl'];
$authtoken = $row['authtoken'];


 	$recordInfo = $entityData->{'data'};
    $mobile = $recordInfo['cf_1185'];
    $url = $middlewareurl . 'send-template';
    $headers = array(
        'Authorization: '. $authtoken,
        'Content-Type: application/json'
    );
    
    $data = array(
        "to" => "91". $mobile,
        "name" => "innca_2nd_visit_form"
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    print_r($res); 
    curl_close($ch);
}
?>
