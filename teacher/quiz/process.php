<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

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

    if (empty($_POST['classId'])) {
        $errors['classId'] = "Class Field is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book Field is Required!";
    }
    if (empty($_POST['title'])) {
        $errors['title'] = "Quiz Title Field is Required!";
    } 
    if (empty($_POST['total_score'])) {
        $errors['total_score'] = "Score Field is Required!";
    }
    if (empty($_POST['due_date'])) {
        $errors['due_date'] = "Date Field is Required!";
    }
    else {
        $data = [
            'class_id' => $_POST['classId'],
            'book_id' => $_POST['bookSelect'],
            'title' => $_POST['title'],
            'total_score' => $_POST['total_score'],
            'due_date' => $_POST['due_date'],
        ];
        $insert = insert('quiz', $data);
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['type'] == 'edit') {

    $errors = [];

    if (empty($_POST['classId'])) {
        $errors['classId'] = "Class Field is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book Field is Required!";
    }
    if (empty($_POST['title'])) {
        $errors['title'] = "Quiz Title Field is Required!";
    } 
    if (empty($_POST['total_score'])) {
        $errors['total_score'] = "Score Field is Required!";
    }
    if (empty($_POST['due_date'])) {
        $errors['due_date'] = "Date Field is Required!";
    } else {
        $data = [
            'class_id' => $_POST['classID'],
            'book_id' => $_POST['bookSelect'],
            'title' => $_POST['title'],
            'total_score' => $_POST['total_score'],
            'due_date' => $_POST['due_date'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('quiz', $data, $where);
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('quiz', $where);
    echo json_encode($insert);
    exit();
};
