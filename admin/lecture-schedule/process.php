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

if (@$_POST['type'] == 'create-schedule') {

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
    exit();
}

if (@$_POST['type'] == 'edit') {
    $errors = [];
    if (empty($_POST['classID'])) {
        $errors['classID'] = "Class is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book is Required!";
    }
    if (empty($_POST['lecture_date'])) {
        $errors['lecture_date'] = "Date is Required!";
    }
    if (empty($_POST['start_time'])) {
        $errors['start_time'] = "Time is Required!";
    }
    if (empty($_POST['end_time'])) {
        $errors['end_time'] = "Time is Required!";
    }
    if (empty($_POST['teacher_id'])) {
        $errors['teacher_id'] = "Teacher is Required!";
    } else {
        $data = [
            'class_id' => $_POST['classID'],
            'book_id' => $_POST['bookSelect'],
            'lecture_date' => $_POST['lecture_date'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'teacher_id' => $_POST['teacher_id'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('lecture_schedule', $data, $where);
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('lecture_schedule', $where);
    echo json_encode($insert);
    exit();
};


