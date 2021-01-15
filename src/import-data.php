<?php
// Load the database configuration file
include_once 'db-connect.php';

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $orderNumber  = $line[0];
                $orderPlaced  = $line[1];
                $orderFilled  = $line[2];
                $itemDesc     = $line[3];
                $email        = $line[4];
                $firstName    = $line[5];
                $lastName     = $line[6];
                $address1     = $line[7];
                $address2     = $line[8];
                $city         = $line[9];
                $state        = $line[10];
                $zip          = $line[11];
                $phoneNumber  = $line[12];
                
                // Insert member data in the database
                $db->query("INSERT INTO orders (orderNumber, orderPlaced, orderFilled, itemDesc, email, firstName, lastName, address1, address2, city, state, zip, phoneNumber, created, modified) VALUES ('$orderNumber', '$orderPlaced', '$orderFilled', '$itemDesc', '$email', '$firstName', '$lastName', '$address1', '$address2', '$city', '$state', '$zip', '$phoneNumber', NOW(), NOW())");
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=success';
        }else{
            $qstring = '?status=error';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: index.php".$qstring);

?>