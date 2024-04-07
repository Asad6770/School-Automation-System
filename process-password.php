<?php
require_once 'config.php';
session_start();
$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $phone = $_POST['phone_no'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    //teacher
    if (substr($username, 0, 2) == "tc") {
        $sql = "SELECT * FROM teacher WHERE username='$username' AND phone_no='$phone'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            // exit();
            if ($password !== $cpassword) {
                $_SESSION['message'] = "Error: Your Password and Confirm Password is not Matched!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (strlen(trim($password)) < 8) {
                $_SESSION['message'] = "Error: Password must have atleast 8 characters!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Number!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Capital Letter!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Lowercase Letter!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } else {
                $id = $row['id'];
                $pass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE teacher SET password = '$pass' WHERE $id";
                // print_r($sql);
                // exit();
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['message'] = "You have successfully Changed Password";
                    header("Location: " . $ROOT . "/teacher/dashboard.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: Connection failed: " . mysqli_error($conn);
                    header("Location: " . $ROOT . "/change-password.php");
                    exit();
                }
            }
        }
    }
    //student
    if (substr($username, 0, 2) == "st") {
        $sql = "SELECT * FROM student WHERE username='$username' AND phone_no='$phone'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            // exit();
            if ($password !== $cpassword) {
                $_SESSION['message'] = "Error: Your Password and Confirm Password is not Matched!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (strlen(trim($password)) < 8) {
                $_SESSION['message'] = "Error: Password must have atleast 8 characters!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Number!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Capital Letter!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Lowercase Letter!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } else {
                $id = $row['id'];
                $pass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE student SET password = '$pass' WHERE $id";
                // print_r($sql);
                // exit();
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['message'] = "You have successfully Changed Password";
                    header("Location: " . $ROOT . "/change-password.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: Connection failed: " . mysqli_error($conn);
                    header("Location: " . $ROOT . "/change-password.php");
                    exit();
                }
            }
        }
    }

    //parent
    if (substr($username, 0, 2) == "pt") {
        $sql = "SELECT * FROM parent WHERE username='$username' AND phone_no='$phone'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            // exit();
            if ($password !== $cpassword) {
                $_SESSION['message'] = "Error: Your Password and Confirm Password is not Matched!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (strlen(trim($password)) < 8) {
                $_SESSION['message'] = "Error: Password must have atleast 8 characters!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Number!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Capital Letter!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Lowercase Letter!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } else {
                $id = $row['id'];
                $pass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE parent SET password = '$pass' WHERE $id";
                // print_r($sql);
                // exit();
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['message'] = "You have successfully Changed Password";
                    header("Location: " . $ROOT . "/change-password.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: Connection failed: " . mysqli_error($conn);
                    header("Location: " . $ROOT . "/change-password.php");
                    exit();
                }
            }
        }
    }
}
