<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if (@$_POST["type"] == "create") {
    for ($i = 0; $i < count($_POST['selected_course_id']); $i++) {
        $data = [
            'book_id ' => $_POST['selected_course_id'][$i],
            'class_id ' => $_POST['class_id'],
            'student_id ' => $_SESSION['id'],
        ];
        $insert = insert('courses', $data);
    }
    echo json_encode($insert);
}


if (@$_POST["type"] == "edit") {
    for ($i = 0; $i < count($_POST['id']); $i++) {
        $data = [
            'book_id ' => $_POST['selected_course_id'][$i],
            'class_id ' => $_POST['class_id'],
            'student_id ' => $_SESSION['id'],
        ];
        $where = 'id= ' . $_POST['id'][$i];
        $update = update('courses', $data, $where);
    }
    echo json_encode($insert);
}