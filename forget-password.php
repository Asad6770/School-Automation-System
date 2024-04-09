<?php
require_once 'config.php';
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>School Automation System</title>
    <link rel="stylesheet" href="<?= $ROOT ?>/assets/css/login.css">
</head>

<body>
    <div class="main">
        <h3>Please Change Your Password!</h3>
        <?php
        if (isset($_SESSION['message'])) {
            $message_class = strpos($_SESSION['message'], 'Error') !== false ? 'error' : 'success';
            echo "<div class='message $message_class'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
        ?>
        <form action="process-forget.php" method="POST" autocomplete="off">
            <label for="username">
                Username
            </label>
            <input type="text" id="username" name="username" placeholder="Enter your Username" required>
            <label for="phone_no">
                Phone No
            </label>
            <input type="text" id="phone_no" name="phone_no" placeholder="Enter your Phone No" required>

            <label for="password">
                Password:
            </label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>

            <label for="cpassword">
                Confirm Password:
            </label>
            <input type="password" id="cpassword" name="cpassword" placeholder="Enter your Confirm Password" required>

            <div class="wrap">
                <button type="submit">
                    Save
                </button>
            </div>
        </form>
        <!-- <a href="<?= $ROOT ?>/logout.php">
            Go back to login Page
        </a> -->
    </div>
</body>

</html>
<?php

?>