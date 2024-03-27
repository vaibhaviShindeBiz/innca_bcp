<?php


function Reminder_for_visit($entityData) {

include('config.inc.php');
$conn = mysqli_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
$query = "SELECT * FROM middleware"; 
$result = $conn->query($query);
$row = $result->fetch_assoc();
$middlewareurl = $row['middlewareurl'];
$authtoken = $row['authtoken'];


 	$recordInfo = $entityData->{'data'};

    $parent_id = explode('x', $recordInfo['parent_id']);
    $leadsID = $parent_id[1];
    
    $leadsRecordModel = Vtiger_Record_Model::getInstanceById($leadsID);

    $mobile = $leadsRecordModel->get('mobile');

    
	$parent_id = $recordInfo['parent_id'];
	$subject = $recordInfo['subject'];
	$date = $recordInfo['date_start'];
	$time_start = $recordInfo['time_start'];
	$time_end = $recordInfo['time_end'];
	$activitytype = $recordInfo['activitytype'];

    $from = date('h:i A', strtotime($time_start));
    $to = date('h:i A', strtotime($time_end));


    $url = $middlewareurl . 'send-template';
    $headers = array(
        'Authorization: '. $authtoken,
        'Content-Type: application/json'
    );
    
    $data = array(
        "to" => "91". $mobile,
        "name" => "innca_reminder_for_visit",
        "components" => array(
            array(
                "type" => "body",
                "parameters" => array(
                    array(
                        "type" => "text",
                        "text" => $subject
                    ),
                    array(
                        "type" => "text",
                        "text" => $activitytype
                    ),
                    array(
                        "type" => "text",
                        "text" => $date
                    ),
                    array(
                        "type" => "text",
                        "text" => $from
                    ),
                    array(
                        "type" => "text",
                        "text" => $to
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
    curl_exec($ch);
    curl_close($ch);
}
?>
