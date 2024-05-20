<?php
require_once '../../include/function.php';
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
