<?php
require_once 'config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link href="<?= $ROOT ?>/assets/upload/logo.png" rel="icon">
    <title>Forget Password</title>
    <link href="<?= $ROOT ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $ROOT ?>/assets/css/dashboard.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <?php
                                        if (isset($_SESSION['message'])) {
                                            $message_class = strpos($_SESSION['message'], 'Error') !== false ? 'alert-danger' : 'alert-success';
                                            echo "<div class='alert $message_class'>{$_SESSION['message']}</div>";
                                            unset($_SESSION['message']); // Clear the message after displaying it
                                        }
                                        ?>
                                        <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                                    </div>
                                    <form action="process.php" method="POST" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Your Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Enter Your Phone No" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your New Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Your Confirm New Password" required>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>