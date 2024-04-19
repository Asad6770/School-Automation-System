<?php

require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if (isset($_GET['class_id'])) {
    $where = 'class_id=' . $_GET['class_id'];
    $data = select('book', '*', $where);

    if (count($data) > 0) {
        $output = '<option value="">Select a Book</option>';
        foreach ($data as $value) {
            $output .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
    } else {
        $output = '<option value="">Select a Book</option>';
        $output .= '<option>No Books Found</option>';
    }
    echo $output;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < count($_POST['student_id']); $i++) {
        $data = [
            'student_id' => $_POST['student_id'][$i],
            'class_id' => $_POST['class_id'],
            'book_id' => $_POST['book_id'],
            'teacher_id' => $_SESSION['id'],
            'attendance_date' => $_POST['attendance_date'],
            'attendance_status' => $_POST['attendance_status'][$i],
        ];
        $insert = insert('attendance', $data);
    }
    echo json_encode($insert);
}
