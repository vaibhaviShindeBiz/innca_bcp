<?php


function Acknowledgement_msg($entityData) {

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
        $query1 = $adb->pquery("SELECT relcrmid FROM vtiger_crmentityrel WHERE crmid = ? AND module = 'Potentials' AND relmodule = 'Quotes'", array($potentialId));
        if ($query1) {
            $quoteRow = $adb->fetchByAssoc($query1);
            if ($quoteRow) {
                $quoteId = $quoteRow['relcrmid'];

                $quoteRecordModel = Vtiger_Record_Model::getInstanceById($quoteId);
                if ($quoteRecordModel) {
                    $quoteFields = $quoteRecordModel->getData();
                    $quoteNo = $quoteFields['quote_no'];
                    // echo "Quote Number: " . $quoteNo; echo "<pre>";
                }
            }
        }
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $hostname = $_SERVER['HTTP_HOST'];
        $qrCodeurl = "$protocol://$hostname/innca/QRcodeForPayment/randomqr.png";
        $pdfLink= "$protocol://$hostname/innca/QuotePdf/" . $quoteNo . ".pdf";
    

        $url = $middlewareurl . 'send-template';
        $headers = array(
            'Authorization: '. $authtoken,
            'Content-Type: application/json'
        );
        $data = array(
            "to" => "91".$phone,
            "name" => "innca_acknowledgment_2ndmessage",
            "components" => array(
                array(
                    "type" => "header",
                    "parameters" => array(
                        array(
                            "type" => "document",
                            "document" => array(
                                "link" => $pdfLink,
                            )
                        )
                    )
                )
            )
        );
        // print_r($data); exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response1 = curl_exec($ch);
        print_r($response1);  exit;
        curl_close($ch);
    }
}
?>
