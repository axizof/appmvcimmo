<?php

$servername = "mysql.axiz.io";
$username = "flashmcqueen";
$password = "flashmcqueen0550002D";
$dbname = "immoappmvc";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}


$code = $_GET['code'];
$logId = $_GET['LogId'];


$sql = "SELECT * FROM PromoCode WHERE Code = '$code' AND Enabled = 1 AND (LogId IS NULL OR LogId = $logId) AND UseMax > 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    
    $response = array(
        "valid" => true,
        "type" => $row['Type'],
        "reduction" => $row['Reduction']
    );

    echo json_encode($response);
} else {

    $response = array(
        "valid" => false
    );

    echo json_encode($response);
}


$conn->close();

?>
