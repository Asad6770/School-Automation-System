<?php
require_once 'config.php';
require_once 'include/function.php';
session_start();


if ($_POST['type'] == 'change-password') {
    $errors = [];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    if (substr($_SESSION['username'], 0, 2) == "tc") {
        $checkOldPassword = select('teacher', '*', 'id=' . $_SESSION['id']);
        $decode = password_verify($oldPassword, $checkOldPassword[0]['password']);
        if ($decode == true) {
            $data = [
                'password' => password_hash($_POST['newPassword'], PASSWORD_BCRYPT),
            ];
            $where = 'id=' . $checkOldPassword[0]['id'];
            $update = update('teacher', $data, $where);
            echo json_encode($update);
            exit();
        } else { 
                $errors['oldPassword'] = "Old Password do not match!";
        }
        $data = ['status' => empty($errors), 'error' => $errors];
        echo json_encode($data);
        exit();
    }

    if (substr($_SESSION['username'], 0, 2) == "st") {
        $checkOldPassword = select('student', '*', 'id=' . $_SESSION['id']);
        $decode = password_verify($oldPassword, $checkOldPassword[0]['password']);
        if ($decode == true) {
            $data = [
                'password' => password_hash($_POST['newPassword'], PASSWORD_BCRYPT),
            ];
            $where = 'id=' . $checkOldPassword[0]['id'];
            $update = update('student', $data, $where);
            echo json_encode($update);
            exit();
        } else { 
                $errors['oldPassword'] = "Old Password do not match!";
        }
        $data = ['status' => empty($errors), 'error' => $errors];
        echo json_encode($data);
        exit();
    }

    if (substr($_SESSION['username'], 0, 2) == "pt") {
        $checkOldPassword = select('parrent', '*', 'id=' . $_SESSION['id']);
        $decode = password_verify($oldPassword, $checkOldPassword[0]['password']);
        if ($decode == true) {
            $data = [
                'password' => password_hash($_POST['newPassword'], PASSWORD_BCRYPT),
            ];
            $where = 'id=' . $checkOldPassword[0]['id'];
            $update = update('parrent', $data, $where);
            echo json_encode($update);
            exit();
        } else { 
                $errors['oldPassword'] = "Old Password do not match!";
        }
        $data = ['status' => empty($errors), 'error' => $errors];
        echo json_encode($data);
        exit();
    }
}



if ($_POST['type'] == 'forget-password') {

    $username = $_POST['username'];
    $phone = $_POST['phone_no'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if (empty($username)) {
        $_SESSION['message'] = "Error: Username is Required!";
        header("Location: " . $ROOT . "/forget-password.php");
        exit();
    } elseif (empty($phone)) {
        $_SESSION['message'] = "Error: Phone Number is Required!";
        header("Location: " . $ROOT . "/forget-password.php");
        exit();
    } elseif (empty($password)) {
        $_SESSION['message'] = "Error: Password is Required!";
        header("Location: " . $ROOT . "/forget-password.php");
        exit();
    } elseif (empty($cpassword)) {
        $_SESSION['message'] = "Error: Confirm Password is Required!";
        header("Location: " . $ROOT . "/forget-password.php");
        exit();
    }
    //teacher
    else if (substr($username, 0, 2) == "tc") {
        $sql = "SELECT * FROM teacher WHERE username='$username' AND phone_no='$phone'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            // exit();
            if ($password !== $cpassword) {
                $_SESSION['message'] = "Error: Your Password and Confirm Password is not Matched!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (strlen(trim($password)) < 8) {
                $_SESSION['message'] = "Error: Password must have atleast 8 characters!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Number!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Capital Letter!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Lowercase Letter!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } else {
                $id = $row['id'];
                $pass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE teacher SET password = '$pass' WHERE id = $id";
                // print_r($sql);
                // exit();
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['message'] = "You have successfully Changed Password";
                    header("Location: " . $ROOT . "/index.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: Connection failed: " . mysqli_error($conn);
                    header("Location: " . $ROOT . "/forget-password.php");
                    exit();
                }
            }
        } else {
            $_SESSION['message'] = "Error: Your Username not Found!";
            header("Location: " . $ROOT . "/forget-password.php");
            exit();
        }
    }
    //student
    elseif (substr($username, 0, 2) == "st") {
        $sql = "SELECT * FROM student WHERE username='$username' AND phone_no='$phone'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            // exit();
            if ($password !== $cpassword) {
                $_SESSION['message'] = "Error: Your Password and Confirm Password is not Matched!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (strlen(trim($password)) < 8) {
                $_SESSION['message'] = "Error: Password must have atleast 8 characters!";
                header("Location: " . $ROOT . "/change-password.php");
                exit();
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Number!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Capital Letter!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Lowercase Letter!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } else {
                $id = $row['id'];
                $pass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE student SET password = '$pass' WHERE id = $id";
                // print_r($sql);
                // exit();
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['message'] = "You have successfully Changed Password";
                    header("Location: " . $ROOT . "/index.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: Connection failed: " . mysqli_error($conn);
                    header("Location: " . $ROOT . "/forget-password.php");
                    exit();
                }
            }
        } else {
            $_SESSION['message'] = "Error: Your Username not Found!";
            header("Location: " . $ROOT . "/forget-password.php");
            exit();
        }
    }

    //parent
    elseif (substr($username, 0, 2) == "pt") {
        $sql = "SELECT * FROM parent WHERE username='$username' AND phone_no = '$phone' ";
        $result = mysqli_query($conn, $sql);
        // print_r($row);
        //             exit();
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($password !== $cpassword) {
                $_SESSION['message'] = "Error: Your Password and Confirm Password is not Matched!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (strlen(trim($password)) < 8) {
                $_SESSION['message'] = "Error: Password must have atleast 8 characters!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Number!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Capital Letter!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $_SESSION['message'] = "Error: Your Password Must Contain At Least 1 Lowercase Letter!";
                header("Location: " . $ROOT . "/forget-password.php");
                exit();
            } else {
                $id = $row['id'];
                $pass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "UPDATE parent SET password = '$pass' WHERE id = $id";
                // print_r($sql);
                // exit();
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['message'] = "You have successfully Changed Password";
                    header("Location: " . $ROOT . "/index.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: Connection failed: " . mysqli_error($conn);
                    header("Location: " . $ROOT . "/forget-password.php");
                    exit();
                }
            }
        } else {
            $_SESSION['message'] = "Error: Your Username not Found!";
            header("Location: " . $ROOT . "/forget-password.php");
            exit();
        }
    }
}
