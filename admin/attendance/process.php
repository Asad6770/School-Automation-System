<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

if (@$_POST['type'] == 'create') {

    $errors = [];

    if (empty($_POST['attendance_status'])) {
        $errors['attendance_status'] = "Name is Required!";
    }

    if (empty($_POST['attendance_date'])) {
        $errors['attendance_date'] = "Date is Required!";
    } else {
        for ($i = 0; $i < count($_POST['teacher_id']); $i++) {
            $data = [
                'teacher_id' => $_POST['teacher_id'][$i],
                'attendance_status' => $_POST['attendance_status'][$i],
                'attendance_date' => $_POST['attendance_date'],
            ];
            $insert = insert('teacher_attendance', $data);
        }
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['type'] == 'edit') {
    $data = [
        'attendance_status' => $_POST['attendance_status'],
    ];
    $where = 'id= ' . $_POST['id'];
    $update = update('teacher_attendance', $data, $where);
    echo json_encode($update);
    exit();
}


if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('book', $where);
    echo json_encode($insert);
    exit();
};
