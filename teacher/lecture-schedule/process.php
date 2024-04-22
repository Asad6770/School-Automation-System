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

if (@$_POST['type'] = 'create') {
    for ($i=0; $i < count($_POST['lecture_date']) ; $i++) { 
        $data = [
            'lecture_date' => $_POST['lecture_date'][$i],
            'class_id' => $_POST['class_id'],
            'book_id' => $_POST['book_id'],
            'teacher_id' => $_POST['teacher_id'][$i],
            'start_time' => $_POST['start_time'][$i],
            'end_time' => $_POST['end_time'][$i],
        ];
        $insert = insert('lecture_schedule', $data);
    }
    echo json_encode($insert);
}

