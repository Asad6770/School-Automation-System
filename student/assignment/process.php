<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();


if ($_POST['type'] == 'submission') {

    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $data = [
        'answer' =>  $answer,
        'assignment_id' => $_POST['assignment_id'],
        'student_id' => $_SESSION['id'],
    ];
    $insert = insert('submission', $data);
    echo json_encode($insert);
    exit();
}
