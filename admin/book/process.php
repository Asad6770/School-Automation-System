<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';

if (@$_POST['type'] == 'create') {

    $errors = [];

    if (empty($_POST['name'])) {
        $errors['name'] = "Name is Required!";
    }

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class is Required!";
    }
    if (empty($_POST['selection_type'])) {
        $errors['selection_type'] = "Book Selection Type is Required!";
    } else {
        $data = [
            'name' => $_POST['name'],
            'class_id' => $_POST['class_id'],
            'selection_type' => $_POST['selection_type'],
        ];
        $insert = insert('book', $data);
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['type'] == 'edit') {

    $errors = [];
    if (empty($_POST['name'])) {
        $errors['name'] = "Name is Required!";
    }

    if (empty($_POST['class_id'])) {
        $errors['class_id'] = "Class is Required!";
    }
    if (empty($_POST['selection_type'])) {
        $errors['selection_type'] = "Book Selection Type is Required!";
    } else {
        $data = [
            'name' => $_POST['name'],
            'class_id' => $_POST['class_id'],
            'selection_type' => $_POST['selection_type'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('book', $data, $where);
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('book', $where);
    echo json_encode($insert);
    exit();
};
