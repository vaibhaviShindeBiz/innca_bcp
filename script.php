<?php

// Connect to the database using mysqli (replace with your actual database credentials)
$mysqli = new mysqli('localhost', 'bitechno_incca', '+7qjUE%&#&^n', 'bitechno_incca');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Assuming $recordId contains the desired ID value
$recordId = $_GET['recordId'];

// Execute a query to fetch the productcategory
$sql = "SELECT * FROM vtiger_products WHERE productid = '$recordId'";


// Perform the query
$result = $mysqli->query($sql);



// Initialize an empty response array
$response = array();


if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();


    if ($row) {
        // Assign the fetched value to the response array
        $response['prodid']=$row['productid'];
        $prodname=$row['productname'];
        $response['productcategory'] = $row['productcategory'];
        $response['usageunit'] = $row['usageunit'];
        $response['unit_price'] = $row['unit_price'];
        $response['glacct'] = $row['glacct'];
               
        $response['length'] = $row['length'];
        $response['height'] = $row['height'];
      
    }




    $sql2 = "SELECT productid, productcategory, glacct FROM vtiger_products WHERE productname = '$prodname' ORDER BY CASE WHEN productid = $recordId THEN 0 ELSE 1 END";
    
    $result2 = $mysqli->query($sql2);
    if ($result2) {
        // Loop through the result set and fetch each row
        while ($row2 = $result2->fetch_assoc()) {
            // Append each row to the array
            $rowsWithSameProductName[] = $row2;
        }
    
        // Free the result set
        $result->free();

    }

    

$lengthMM = $response['length']; 
$heightMM = $response['height']; 
$ratePerSqft = $response['unit_price']; 


$lengthFt = $lengthMM / 304.8; 
$heightFt = $heightMM / 304.8;


$squareFootage = $lengthFt * $heightFt;


$totalCost = $squareFootage * $ratePerSqft;


$response['sqfoot'] = number_format($squareFootage, 2);
$response['totalcost'] = number_format($totalCost, 2);




    // Free the result set
    $result->free();
}

// Close the database connection
$mysqli->close();

$data = array('data1' => $response, 'data2' => $rowsWithSameProductName);

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($data);

?>
