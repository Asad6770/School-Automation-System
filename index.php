<?php
require_once 'config.php';
session_start();
if (isset($_SESSION['username'])) {
  if (substr($_SESSION['username'], 0, 5) == "admin") {
    header("Location: " . $ROOT . "/admin/dashboard.php");
  } 
  elseif (substr($_SESSION['username'], 0, 2) == "tc") {
    header("Location: " . $ROOT . "/teacher/dashboard.php");
    
  } elseif (substr($_SESSION['username'], 0, 2) == "st") {
    header("Location: " . $ROOT . "/student/dashboard.php");
  } elseif (substr($_SESSION['username'], 0, 2) == "pt") {
    header("Location: " . $ROOT . "/parent/dashboard.php");
  } 
}
else {
  
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>School Automation System</title>
    <link rel="stylesheet" href="<?= $ROOT ?>/assets/css/login.css">
  </head>

  <body>
    <div class="main">
      <h1>School Automation System</h1>
      <h3>Enter your login credentials</h3>
      <?php
      if (isset($_SESSION['message'])) {
        $message_class = strpos($_SESSION['message'], 'Error') !== false ? 'error' : 'success';
        echo "<div class='message $message_class'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']); // Clear the message after displaying it
      }
      ?>
      <form action="login.php" method="POST" autocomplete="off">
        <label for="username">
          Username:
        </label>
        <input type="text" id="username" name="username" placeholder="Enter your Username" required>

        <label for="password">
          Password:
        </label>
        <input type="password" id="password" name="password" placeholder="Enter your Password" required>

        <div class="wrap">
          <button type="submit">
            Submit
          </button>
        </div>
      </form>
      <p>
        <a href="<?= $ROOT ?>/change-password.php" style="text-decoration: none;">
          Forget Password
        </a>
      </p>
    </div>
  </body>

  </html>
<?php
}
?>