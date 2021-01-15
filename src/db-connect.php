<?php
    $servername = "xds-sample.cubo24qxoqtb.us-east-2.rds.amazonaws.com";
    $username = "timperk";
    $password = "CB0fUxXHg8Po";
    $dbname = "xdsSampleProd";

    // Create connection
    $db = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
    }
?>