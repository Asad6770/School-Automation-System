<?php
session_start();
require_once 'C:\xampp\htdocs\SAS\config.php';
include_once "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < count($_POST['student_id']); $i++) {
        $data = [
            'student_id ' =>$_POST['student_id'][$i],
            'class_id ' => $_POST['class_id'],
            'subject_id ' => $_POST['subject_id'],
            'teacher_id ' => $_SESSION['id'],
            'status ' => $_POST['status'][$i],
        ];
        $insert = insert('attendance', $data);
    }
    echo json_encode($insert);
    exit();
}
