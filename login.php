<?php

require_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['password'] == '123') {
        echo $_SESSION['username'] = $_POST['username'];
        header("Location: " . $ROOT . "/change-password.php");
        exit();
    } else {
        // admin check
        $username = strtolower($_POST['username']);
        $password = $_POST['password'];

        if (substr($username, 0, 5) == "admin") {

            if (empty($username)) {

                $_SESSION['message'] = "Error: Username is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else if (empty($password)) {

                $_SESSION['message'] = "Error: Password is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else {

                $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);

                    if ($row['password'] === $password) {
                        $_SESSION['username'] = $row['username'];
                        header("Location: " . $ROOT . "/admin/dashboard.php");
                    } else {
                        $_SESSION['message'] = "Error: Incorect Password";
                        header("Location: " . $ROOT . "/index.php");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Error: Incorect Username";
                    header("Location: " . $ROOT . "/index.php");
                    exit();
                }
            }
        }

        // teacher check
        else if (substr($username, 0, 2) == "tc") {

            if (empty($username)) {
                $_SESSION['message'] = "Error: Username is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else if (empty($password)) {
                $_SESSION['message'] = "Error: Password is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else {

                $sql = "SELECT * FROM teacher WHERE username='$username'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    $decode = password_verify($password, $row['password']);
                    if ($decode === true) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['fullname'] = $row['fullname'];
                        header("Location: " . $ROOT . "/teacher/dashboard.php");
                        exit();
                    } else {
                        $_SESSION['message'] = "Error: Incorect password!";
                        header("Location: " . $ROOT . "/index.php");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Error: Incorect Username!";
                    header("Location: " . $ROOT . "/index.php");
                    exit();
                }
            }
        }
        // student check
        else if (substr($username, 0, 2) == "st") {
            if (empty($username)) {
                $_SESSION['message'] = "Error: Username is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else if (empty($password)) {
                $_SESSION['message'] = "Error: Password is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else {
                $sql = "SELECT * FROM student WHERE username='$username'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) === 1) {

                    $row = mysqli_fetch_assoc($result);
                    $decode = password_verify($password, $row['password']);
                    if ($decode === true) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['fullname'] = $row['fullname'];
                        header("Location: " . $ROOT . "/student/dashboard.php");
                        exit();
                    } else {
                        $_SESSION['message'] = "Error: Incorect User name or password!";
                        header("Location: " . $ROOT . "/index.php");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Error: Incorect User name or password!";
                    header("Location: " . $ROOT . "/index.php");
                    exit();
                }
            }
        }
        // parent check
        else if (substr($username, 0, 2) == "pt") {
            if (empty($username)) {
                $_SESSION['message'] = "Error: Username is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else if (empty($password)) {
                $_SESSION['message'] = "Error: Password is Required!";
                header("Location: " . $ROOT . "/index.php");
                exit();
            } else {
                $sql = "SELECT * FROM parent WHERE username='$username' AND password='$password'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) === 1) {

                    $row = mysqli_fetch_assoc($result);
                    $decode = password_verify($password, $row['password']);
                    if ($decode === true) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['fullname'] = $row['fullname'];
                        header("Location: " . $ROOT . "/parent/feedback.php");
                        exit();
                    } else {
                        $_SESSION['message'] = "Error: Incorect User name or password!";
                        header("Location: " . $ROOT . "/index.php");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Error: Incorect User name or password!";
                    header("Location: " . $ROOT . "/index.php");
                    exit();
                }
            }
        } else {
            $_SESSION['message'] = "Error: Please entered valid Username!";
            header("Location: " . $ROOT . "/index.php");
            exit();
        }
    }
}
