<?php
include_once 'config.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Not Allowed</title>
    <link href="<?= $ROOT ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Access Denied</h4>
            <p>Sorry, You are not authorized to access this page.</p>
            <button onclick="goBack()" class="btn btn-primary">Go Back</button>
        </div>
    </div>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>