<?php
require_once '../../include/function.php';

if (@$_POST['type'] == 'edit') {
    $data = [
        'course_selection' => $_POST['course_selection'],
    ];
    $where = 'id=' . $_POST['id'];
    $update = update('admin', $data, $where);
    $msg = [
        'status' => true,
        'msg' => 'Course Selection is '.$_POST['course_selection']
    ];
    echo json_encode($msg);
    exit();
}
