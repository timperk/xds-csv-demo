<?php
// Load the database configuration file
include_once 'db-connect.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'success':
            $statusType = 'success';
            $statusMsg = 'Your order has been uploaded successfully.';
            break;
        case 'error':
            $statusType = 'invalid';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'invalid';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>XDS CSV Validator Demo</title>
  <link rel="stylesheet" href="/assets/css/pages/index.css">
</head>

<body>
    <p class="description">
        <strong>Upload your CSV file below to validate</strong>
    </p>
    
    <form action="import-data.php" id="uploadForm" method="post" enctype="multipart/form-data">
        <div class="block">
            <input type="file" accept=".csv" id="file" name="file" />
        </div>

        <div class="block" id="invalidMessages">
            <input type="submit" name="importSubmit" id="submitBtn" value="Upload to Database">
        </div>
    </form>

    <!-- Display upload status message -->
    <?php if(!empty($statusMsg)){ ?>
    <div>
        <div class="block <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
    </div>
    <?php } ?>
    

    <script async src="/assets/js/all.js"></script>
</body>
</html>