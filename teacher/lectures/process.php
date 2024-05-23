<?php
require_once '../../include/teacher-config.php';
require_once '../../include/function.php';

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

if (@$_POST['type'] == 'create') {

    $errors = [];

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book is Required!";
    }

    if (empty($_POST['lecture_no'])) {
        $errors['lecture_no'] = "Lecture No is Required!";
    }

    if (empty($_POST['lecture'])) {
        $errors['lecture'] = "Lecture Detail is Required!";
    } 

    if (empty($errors)) {
        $data = [
            'class_id' => $_POST['class_id'],
            'book_id' => $_POST['bookSelect'],
            'lecture_no' => $_POST['lecture_no'],
            'lecture' => $_POST['lecture'],
            'teacher_id' => $_SESSION['id'],
        ];
        $insert = insert('lectures', $data);
        echo json_encode($insert);
    } else {
        echo json_encode(['status' => false, 'error' => $errors]);
    }
    exit();
}


if (@$_POST['type'] == 'edit') {

    $errors = [];

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book is Required!";
    }

    if (empty($_POST['lecture_no'])) {
        $errors['lecture_no'] = "Lecture No is Required!";
    }

    if (empty($_POST['lecture'])) {
        $errors['lecture'] = "Lecture Detail is Required!";
    } 

    if (empty($errors)) {
        
        $data = [
            'class_id' => $_POST['class_id'],
            'book_id' => $_POST['bookSelect'],
            'lecture_no' => $_POST['lecture_no'],
            'teacher_id' => $_SESSION['id'],
            'lecture' => $_POST['lecture'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('lectures', $data, $where);
        echo json_encode($update);
    } else {
        $data = ['status' => empty($errors), 'error' => $errors];
        echo json_encode($data);
    }
    exit();
}


if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('lectures', $where);
    echo json_encode($insert);
    exit();
};
