<?php
function Welcome_message($entityData) {

include('config.inc.php');
$conn = mysqli_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
$query = "SELECT * FROM middleware"; 
$result = $conn->query($query);
$row = $result->fetch_assoc();
$middlewareurl = $row['middlewareurl'];
$authtoken = $row['authtoken'];


 	$recordInfo = $entityData->{'data'};

    
	$firstname = $recordInfo['firstname'];
	$phone = $recordInfo['mobile'];


    $url = $middlewareurl . 'send-template';
    $headers = array(
        'Authorization: '. $authtoken,
        'Content-Type: application/json'
    );
    
    $data = array(
        "to" => "91".$phone,
        "name" => "innca_welcome",
        "components" => array(
            array(
                "type" => "body",
                "parameters" => array(
                    array(
                        "type" => "text",
                        "text" => $firstname
                    )
                )
            )
        )
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    print_r($response);
    curl_close($ch);
}
?>
