<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
include_once "../function.php";


if (@$_POST['type'] == 'create-teacher') {

    if (empty($_POST['fullname'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $check_id = 'select * from teacher order by id desc limit 1';
        $result = query($check_id);
        if ($result > 0) {
            $user_id = $result[0]['username'];
            $get_number = str_replace('tc', '', $user_id);
            $increase_no = $get_number + 1;
            $get_string = str_pad($increase_no, 3, 0, STR_PAD_LEFT);
            $user = 'tc' . $get_string;

            $data = [
                'fullname' => $_POST['fullname'],
                'username' => $user,
                'password' => '123',
                'phone_no' => $_POST['phone_no'],
                'address' => $_POST['address'],
            ];
            $insert = insert('teacher', $data);
            echo json_encode($insert);
            exit();
        }
    }
}

if (@$_POST['type'] == 'edit-teacher') {

    if (empty($_POST['fullname'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'fullname' => $_POST['fullname'],
            'phone_no' => $_POST['phone_no'],
            'address' => $_POST['address'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('teacher', $data, $where);
        echo json_encode($update);
        exit();
    }
}

if (@$_GET['id']) {
    $where = 'id=' . $_GET['id'];
    $insert = delete('teacher', $where);
    echo json_encode($insert);
    header("Location: " . $ROOT . "/admin/user/student.php");
    exit();
};





if (@$_POST['type'] == 'create-student') {

    if (empty($_POST['fullname'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $check_id = 'select * from student order by id desc limit 1';
        $result = query($check_id);
        if ($result > 0) {
            $user_id = $result[0]['username'];
            $get_number = str_replace('st', '', $user_id);
            $increase_no = $get_number + 1;
            $get_string = str_pad($increase_no, 3, 0, STR_PAD_LEFT);
            $user = 'st' . $get_string;

            $data = [
                'fullname' => $_POST['fullname'],
                'username' => $user,
                'password' => '123',
                'phone_no' => $_POST['phone_no'],
                'address' => $_POST['address'],
                'fk_class_id' => $_POST['fk_class_id'],
            ];
            $insert = insert('student', $data);
            echo json_encode($insert);
            exit();
        }
    }
}

if (@$_POST['type'] == 'edit-student') {

    if (empty($_POST['fullname'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'fullname' => $_POST['fullname'],
            'phone_no' => $_POST['phone_no'],
            'address' => $_POST['address'],
            'fk_class_id' => $_POST['fk_class_id'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('student', $data, $where);
        echo json_encode($update);
        exit();
    }
}






if (@$_POST['type'] == 'create-parent') {

    if (empty($_POST['fullname'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $check_id = 'select * from parent order by id desc limit 1';
        $result = query($check_id);
        if ($result > 0) {
            $user_id = $result[0]['username'];
            $get_number = str_replace('pt', '', $user_id);
            $increase_no = $get_number + 1;
            $get_string = str_pad($increase_no, 3, 0, STR_PAD_LEFT);
            $user = 'pt' . $get_string;

            $data = [
                'fullname' => $_POST['fullname'],
                'username' => $user,
                'password' => '123',
                'phone_no' => $_POST['phone_no'],
            ];
            $insert = insert('parent', $data);
            echo json_encode($insert);
            exit();
        }
    }
}

if (@$_POST['type'] == 'edit-parent') {

    if (empty($_POST['fullname'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'fullname' => $_POST['fullname'],
            'phone_no' => $_POST['phone_no'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('parent', $data, $where);
        echo json_encode($update);
        exit();
    }
}