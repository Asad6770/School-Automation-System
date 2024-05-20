<?php require_once 'include/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Change Password Form</title>
    <link href="<?= $ROOT ?>/assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card shadow-sm my-5">
                    <div class="card-header">
                        <h2 class="text-center">Change Password</h2>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="changePasswordForm" method="post" action="process.php" class="submitData">
                                    <input type="hidden" name="type" value="change-password">
                                    <div class="mb-3">
                                        <label for="oldPassword" class="form-label font-weight-bold">Old Password:</label>
                                        <input type="password" id="oldPassword" name="oldPassword" class="form-control">
                                        <small class="error oldPassword_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label font-weight-bold">New Password:</label>
                                        <input type="password" id="newPassword" name="newPassword" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label font-weight-bold">Confirm New Password:</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <a class="btn btn-success" href="logout.php">Login Page</a>
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= $ROOT ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $ROOT ?>/assets/js/jquery.validate.js"></script>
    <script src="<?= $ROOT ?>/assets/js/script.js"></script>
    <script src="<?= $ROOT ?>/assets/js/sweetalert.js"></script>
    <script>
        $(document).ready(function() {
            $('#changePasswordForm').validate({
                rules: {
                    oldPassword: {
                        required: true
                    },
                    newPassword: {
                        required: true,
                        minlength: 8,
                        containsSpecialCharacters: true,
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: '#newPassword'
                    }
                },
                messages: {
                    oldPassword: {
                        required: 'Please enter your old password.'
                    },
                    newPassword: {
                        required: 'Please enter a new password.',
                        minlength: 'Password must be at least 8 characters long.',
                        containsSpecialCharacters: 'Password must contain at least one special character',
                    },
                    confirmPassword: {
                        required: 'Please confirm your new password.',
                        equalTo: 'Passwords do not match'
                    }
                }
            });
            $.validator.addMethod("containsSpecialCharacters", function(value, element) {
                return /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(value);
            }, "Password must contain at least one special character");
        });
    </script>
</body>

</html>