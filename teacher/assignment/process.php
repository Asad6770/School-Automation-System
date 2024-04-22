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

if (@$_POST['type'] == 'submission-edit') {

    $errors = [];
    if (empty($_POST['obtained_marks'])) {
        $errors['obtained_marks'] = "Name is Required!";
    } else {
        $data = [
            'obtained_marks' => $_POST['obtained_marks'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('submission', $data, $where);
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['type'] = 'create') {
    $errors = [];
    if (empty($_POST['classId'])) {
        $errors['classId'] = "Class is Required!";
    }
    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book is Required!";
    }
    if (empty($_POST['assignment_title'])) {
        $errors['assignment_title'] = "Assignment Title is Required!";
    }
    if (empty($_POST['total_marks'])) {
        $errors['total_marks'] = "Total Marks is Required!";
    }
    if (empty($_POST['due_date'])) {
        $errors['due_date'] = "Due Date is Required!";
    }
    if (empty($_POST['question'])) {
        $errors['question'] = "Question is Required!";
    } else {
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $data = [
            'class_id' => $_POST['classId'],
            'book_id' => $_POST['bookSelect'],
            'assignment_title' => $_POST['assignment_title'],
            'total_marks' => $_POST['total_marks'],
            'due_date' => $_POST['due_date'],
            'question' =>  $question,
            'teacher_id' => $_SESSION['id'],
        ];
        $insert = insert('assignment', $data);
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


