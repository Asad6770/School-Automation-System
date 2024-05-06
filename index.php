<?php
require_once 'config.php';
session_start();
if (isset($_SESSION['username'])) {
  if (substr($_SESSION['username'], 0, 5) == "admin") {
    header("Location: " . $ROOT . "/admin/dashboard.php");
  } elseif (substr($_SESSION['username'], 0, 2) == "tc") {
    header("Location: " . $ROOT . "/teacher/dashboard.php");
  } elseif (substr($_SESSION['username'], 0, 2) == "st") {
    header("Location: " . $ROOT . "/student/dashboard.php");
  } elseif (substr($_SESSION['username'], 0, 2) == "pt") {
    header("Location: " . $ROOT . "/parent/dashboard.php");
  }
} else {

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <link href="<?= $ROOT ?>/assets/upload/logo.png" rel="icon">
    <title>School Automation System - Login</title>
    <link href="<?= $ROOT ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
                        unset($_SESSION['message']); 
                      }
                      ?>
                      <img class="" src="<?= $ROOT ?>/assets/upload/logo.png" width="100" height="100" alt="">

                      <h1 class="h4 font-weight-bold m-4">Login</h1>
                    </div>
                    <form action="login.php" method="POST" id="login">
                      <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Your Username" required>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" required>
                        <a class="" href="<?= $ROOT ?>/forget-password.php">Forget Password</a>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
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
<?php
}
?>