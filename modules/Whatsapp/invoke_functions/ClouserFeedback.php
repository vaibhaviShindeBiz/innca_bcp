<?php
function FeedBackMessage($entityData) {
    include('config.inc.php');
    $conn = mysqli_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
    $query = "SELECT * FROM middleware"; 
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $middlewareurl = $row['middlewareurl'];
    $authtoken = $row['authtoken'];
    $recordInfo = $entityData->{'data'};
    $projectId = $recordInfo['projectid'];
    $projectId = substr($projectId, 3);
    global $adb;
    $query = $adb->pquery("SELECT potentialid FROM vtiger_project WHERE projectid = ?", array($projectId));
    if ($query && $adb->num_rows($query) > 0) {
        $relationRow = $adb->fetchByAssoc($query);
        $potentialId = $relationRow['potentialid']; 
        $potentialRecordModel = Vtiger_Record_Model::getInstanceById($potentialId);
        $phone = $potentialRecordModel->get('mobile');
        $url = $middlewareurl . 'send-template';
        $headers = array(
            'Authorization: '. $authtoken,
            'Content-Type: application/json'
        );
        $data = array(
            "to" => "91".$phone,
            "name" => "innca_feedback",
        );
        // print_r($data); exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response1 = curl_exec($ch);
        print_r($response1); exit;
        curl_close($ch);
    }
}
?>
