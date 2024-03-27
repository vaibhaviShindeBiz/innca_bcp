<?php
include('config.inc.php');
$conn = mysqli_connect($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
$query = "SELECT * FROM middleware"; 
$result = $conn->query($query);
$row = $result->fetch_assoc();
$middlewareurl = $row['middlewareurl'];
$authtoken = $row['authtoken'];
$tokenId = $row['tokenId'];

$currentMonth = date('F');
$fromDate = date('Y-m-01');
$toDate = date('Y-m-t');

if(isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];
}

$response = file_get_contents($middlewareurl.'senttemplatecounter', false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json' . "\r\n"
                    . 'Authorization:' . $authtoken,
        'content' => json_encode([
            'tokenId' => $tokenId,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'currentMonth' => $currentMonth 
        ])
    ]
]));

$responseData = json_decode($response, true);
$responseData['currentMonth'] = $currentMonth;
$responseWithMonth = json_encode($responseData);
echo $responseWithMonth;
?>
