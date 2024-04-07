<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
include_once "../function.php";


if (@$_POST['type'] == 'create') {

    if (empty($_POST['name'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'name' => $_POST['name'],
            'fk_class_id' => $_POST['fk_class_id'],
        ];
        $insert = insert('subject', $data);
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
            'fk_class_id' => $_POST['fk_class_id'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('subject', $data, $where);
        echo json_encode($update);
        exit();
    }
}

if (@$_GET['id']) {
    $where = 'id=' . $_GET['id'];
    $insert = delete('subject', $where);
    echo json_encode($insert);
    header("Location: " . $ROOT . "/admin/subject/index.php");
    exit();
};
