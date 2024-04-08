<?php
function QuoteAcceptance($entityData) {
    include('config.inc.php');
    global $dbconfig; // Assuming $dbconfig is defined in config.inc.php
    
    $conn = mysqli_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
    $query = "SELECT * FROM middleware"; 
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $middlewareurl = $row['middlewareurl'];
    $authtoken = $row['authtoken'];

    $recordInfo = $entityData->{'data'}; 
    $quote_no = $recordInfo['quote_no'];
    $recordid = $recordInfo['id'];
    $recordId = str_replace('4x', '', $recordid);
    $potential_id = $recordInfo['potential_id'];
    $potentialId = str_replace('13x', '', $potential_id); 
    $module = 'Quotes';
    $potentialRecordModel = Vtiger_Record_Model::getInstanceById($potentialId);
    $phone = $potentialRecordModel->get('mobile');
    
    global $adb;
    $getDataPDF = $adb->pquery("SELECT body FROM vtiger_pdfmaker WHERE module = ?", array($module));
    
    if ($getDataPDF && $adb->num_rows($getDataPDF) > 0) {
        $row = $adb->fetchByAssoc($getDataPDF);
        $body = $row['body'];
        require_once 'libraries/mpdf/mpdf/mpdf.php';
        $language = 'en_us';
        $mpdf = new Mpdf('c','A4','','',15,15,15,15,15,15,'UTF-8');  
        $pdfContent = GetPreparedMPDF($mpdf, $recordId, $module, $language);
        // print_r($pdfContent); 
        // Generate file name and directory
        $pdfDirectory = 'C:\\xampp\\htdocs\\innca\\QuotePdf\\';
        $pdfFileName = $pdfDirectory . GenerateName($recordId, $module) . '.pdf';
        
        file_put_contents($pdfFileName, $pdfContent);

        // // Set headers for PDF download
        // header('Pragma: public');
        // header('Expires: 0');
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment; filename="' . basename($pdfFileName) . '"');
        // header('Content-Length: ' . filesize($pdfFileName));
    //    readfile($pdfFileName);
        
    } 
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $hostname = $_SERVER['HTTP_HOST'];
    $qrCodeurl = "$protocol://$hostname/innca/QRcodeForPayment/randomqr.png";
    $pdfLink= "$protocol://$hostname/innca/QuotePdf/" . $quote_no . ".pdf";

    $url = $middlewareurl . 'send-template';
    $headers = array(
        'Authorization: '. $authtoken,
        'Content-Type: application/json'
    );
    $data = array(
        "to" => "91".$phone,
        "name" => "innca_3rd_visit_feedback",
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
    echo "<pre>";
    print_r("response= " . $response1); 
    curl_close($ch);

    $data1 = array(
        "to" => "91".$phone,
        "name" => "innca_qrcode_message",
        "components" => array(
            array(
                "type" => "header",
                "parameters" => array(
                    array(
                        "type" => "image",
                        "image" => array(
                            "link" => $qrCodeurl
                        )
                    )
                )
            )
        )
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data1));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    echo "<pre>";
    print_r("response2= " .$response); exit;
    curl_close($ch);
}

function GetPreparedMPDF(&$mpdf, $record, $module, $language) {
    $header_html = '';
    $body_html = '';
    $footer_html = '';
    $focus = CRMEntity::getInstance($module);
    foreach ($focus->column_fields as $cf_key => $cf_value) {
        $focus->column_fields[$cf_key] = '';
    }
    $focus->retrieve_entity_info($record, $module);  
    $focus->id = $record;
    $PDFContent = GetPDFContentRef($module, $focus, $language); // Call the function
    $Settings = $PDFContent->getSettingsForModule($module);
    $pdf_content = $PDFContent->getContent();
    // Extract content
    $header_html = $pdf_content["header"];
    $body_html = $pdf_content["body"];
    $footer_html = $pdf_content["footer"];
    $mpdf->SetHTMLHeader('<meta charset="utf-8">');
    $mpdf->WriteHTML($header_html); // Write header HTML
    $mpdf->WriteHTML($body_html);   // Write body HTML
    $mpdf->WriteHTML($footer_html); // Write footer HTML

    $pdf_content = $mpdf->Output('', 'S');
   
    return $pdf_content;
}


function GenerateName($record, $module) {
    $focus = CRMEntity::getInstance($module);
    $res =  $focus->retrieve_entity_info($record, $module);  
    $module_tabid = getTabId($module);
    
    global $adb; 
    $result = $adb->pquery("SELECT fieldname FROM vtiger_field WHERE uitype=? AND tabid=?", array('4', $module_tabid));

    if ($adb->num_rows($result) > 0) {
        $fieldname = $adb->query_result($result, 0, "fieldname");
        if (isset($focus->column_fields[$fieldname]) && $focus->column_fields[$fieldname] != "") {
            $name = $focus->column_fields[$fieldname];
        } else {
            $name = 'DefaultName_' . $record . '_' . date("ymdHi");
        }
    } else {
        $name = 'DefaultName_' . $record . '_' . date("ymdHi");
    }
    return $name;
}

function GetPDFContentRef($module, $focus, $language) {
    return new PDFMaker_PDFContent_Model($module, $focus, $language);
}

$pdfPath = QuoteAcceptance($entityData);
?>
