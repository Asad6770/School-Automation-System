<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';

if (@$_POST['type'] == 'create') {

    $errors = [];
    if (empty($_POST['name'])) {
        $errors['name'] = "Name is Required!";
    } else {
        $data = [
            'name' => $_POST['name'],
        ];
        $insert = insert('class', $data);
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
    } else {
        $data = [
            'name' => $_POST['name'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('class', $data, $where);
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('class', $where);
    echo json_encode($insert);
    exit();
};
