<?php
function MaterialSelection($entityData) {
    include('config.inc.php');
    global $dbconfig; 
  
    $conn = mysqli_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
    $query = "SELECT * FROM middleware"; 
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $middlewareurl = $row['middlewareurl'];
    $authtoken = $row['authtoken'];

    $recordInfo = $entityData->{'data'}; 
    // echo "<pre>"; print_r($recordInfo); exit;
    $quote_no = $recordInfo['quote_no'];
    $recordid = $recordInfo['id'];
    $recordId = str_replace('4x', '', $recordid);
    $potential_id = $recordInfo['potential_id'];
    $potentialId = str_replace('13x', '', $potential_id); 

    $productCategories = array_unique(array_column($recordInfo['LineItems'], 'product_category'));
    $productVariants = array_unique(array_column($recordInfo['LineItems'], 'varients'));

    $selectedItems = "Selected items:<br>";
    foreach (array_map(null, $productCategories, $productVariants) as [$category, $variant]) {
        $formattedCategory = "<span style='display: inline-block; width: 90px;'>$category</span>";
        $formattedVariant = "<span style='display: inline-block; width: 150px;'>$variant</span>";
        $selectedItems .= "Category: $formattedCategory - Variant: $formattedVariant<br>";
    }
    
    $module = 'Quotes';
    $potentialRecordModel = Vtiger_Record_Model::getInstanceById($potentialId);
    $phone = $potentialRecordModel->get('mobile');   

    $url = $middlewareurl . 'send-template';
    $headers = array(
        'Authorization: '. $authtoken,
        'Content-Type: application/json'
    );
    $data = array(
        "to" => "91".$phone,
        "name" => "innca_material_selection",
        "components" => array(
            array(
                "type" => "body",
                "parameters" => array(
                    array(
                        "type" => "text",
                        "text" => $selectedItems
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
    $response1 = curl_exec($ch);
    print_r($response1); 
    curl_close($ch);
}
?>
