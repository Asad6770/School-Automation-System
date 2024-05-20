<?php
require_once '../../include/function.php';

if (@$_POST['type'] == 'create') {

    $errors = [];
    $q = 'SELECT * FROM teacher_attendance WHERE attendance_date="'.$_POST['attendance_date'].'"';
  $check_attendance = query($q);
    if ($check_attendance == null) {
        foreach ($_POST['teacher_id'] as $key => $teacher_id) {
            if (empty($_POST['attendance_status'][$key])) {
                $errors["attendance_status_{$key}"] = 'Status is required';
            }
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
    } else {
        $errors['status'] = "Teachers attendance for the selected date has already been saved!";
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
