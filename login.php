<?php

require_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // admin check
    $username = $_POST['username'];
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

            $sql = "SELECT * FROM teacher WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);
                if ($row['password'] === $password) {
                   $_SESSION['username'] = $row['username'];
                    header("Location: " . $ROOT . "/teacher/dashboard.php");
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
            $sql = "SELECT * FROM student WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);
                if ($row['password'] === $password) {
                    $_SESSION['username'] = $row['username'];
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
                if ($row['password'] === $password) {
                    $_SESSION['username'] = $row['username'];
                    header("Location: " . $ROOT . "/parent/dashboard.php");
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
