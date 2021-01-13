<?php
    $servername = "xds-sample.cubo24qxoqtb.us-east-2.rds.amazonaws.com";
    $port = "3306";
    $username = "timperk";
    $password = "CB0fUxXHg8Po";
    $dbname = "xdsSampleProd";

    // Create connection
    $conn = new mysqli($servername, $port, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>