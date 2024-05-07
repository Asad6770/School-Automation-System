<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Finished</title>
    <link href="<?= $ROOT ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<style>
     body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
</style>

<body>
    <div class="card text-center w-50">
        <div class="card-header">
            Quiz Finished
        </div>
        <div class="card-body">
            <h5 class="card-title">Congratulations!</h5>
            <p class="card-text">You have successfully completed the quiz.</p>
            <a href="<?= $ROOT ?>/student/dashboard.php" class="btn btn-primary">Return to Dashboard</a>
        </div>
    </div>
</body>

</html>