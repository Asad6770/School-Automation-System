<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';


if (@$_POST['type'] == 'create') {

    if (empty($_POST['name'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'name' => $_POST['name'],
        ];
        $insert = insert('class', $data);
        echo json_encode($insert);
        exit();
    }
}
if (@$_POST['type'] == 'edit') {

    if (empty($_POST['name'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'name' => $_POST['name'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('class', $data, $where);
        echo json_encode($update);
        exit();
    }
}

if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('class', $where);
    echo json_encode($insert);
};
