<?php
include_once "../config.php";
include_once "include/function.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}  if (empty($_POST['title'])) {

            $_SESSION['message'] = "Error: Title is Required!";
            header("Location: " . $ROOT . "/parent/feedback.php");
            exit();
        } else if (empty($_POST['description'])) {

            $_SESSION['message'] = "Error: Feedback Description is Required!";
            header("Location: " . $ROOT . "/parent/feedback.php");
            exit();
        } else {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'parent_id' =>  $_SESSION['id'],
            ];
            $insert = insert('feedback', $data);
            echo json_encode($insert);
            exit();
        }
    
