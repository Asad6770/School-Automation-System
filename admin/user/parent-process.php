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
                'password' => password_hash('123', PASSWORD_BCRYPT),
                'phone_no' => $_POST['phone_no'],
            ];
            $insert = insert('parent', $data);
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
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('parent', $where);
    echo json_encode($insert);
    exit();
};
