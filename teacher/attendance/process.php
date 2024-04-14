<?php

require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < count($_POST['student_id']); $i++) {
        $data = [
            'student_id ' => $_POST['student_id'][$i],
            'class_id ' => $_POST['class_id'],
            'subject_id ' => $_POST['subject_id'],
            'teacher_id ' => $_SESSION['id'],
            'attendance_date ' => $_POST['attendance_date'],
            'attendance_status ' => $_POST['attendance_status'][$i],
        ];
        $insert = insert('attendance', $data);
    }
    echo json_encode($insert);
}
