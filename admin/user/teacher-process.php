<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';

if (@$_POST['type'] == 'create') {
    $errors = [];
    if (empty($_POST['fullname'])) {
        $errors['fullname'] = "Name is Required!";
    }
    if (empty($_POST['phone_no'])) {
        $errors['phone_no'] = "Phone No is Required!";
    }
    if (empty($_POST['address'])) {
        $errors['address'] = "Address is Required!";
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
                'password' => password_hash('123', PASSWORD_BCRYPT),
                'phone_no' => $_POST['phone_no'],
                'address' => $_POST['address'],
            ];
            $insert = insert('teacher', $data);
            echo json_encode($insert);
            exit();
        }
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['type'] == 'edit') {
    $errors = [];
    if (empty($_POST['fullname'])) {
        $errors['fullname'] = "Name is Required!";
    }
    if (empty($_POST['phone_no'])) {
        $errors['phone_no'] = "Phone No is Required!";
    }
    if (empty($_POST['address'])) {
        $errors['address'] = "Address is Required!";
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
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('teacher', $where);
    echo json_encode($insert);
    exit();
};
