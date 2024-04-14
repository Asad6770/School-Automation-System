<?php

include_once 'include/header.php';

?>

<div class="container-login">
    <div class="row justify-content-center">
        <div class="col-6">
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
                                    <h1 class="h3 font-weight-bold mb-4">Change Password</h1>
                                </div>
                                <form action="process.php" method="POST" autocomplete="off">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="oldPassword" id="oldPassword" placeholder="Enter Your Old Password" required>
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

<?php

include_once 'include/footer.php';

?>