<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';

if (@$_POST['type'] == 'create-voucher') {
    $errors = [];
    $check_fee = null;
    if (!empty($_POST['class_id']) && !empty($_POST['fee_month'])) {
        $q = 'SELECT * FROM voucher WHERE fee_id=' . $_POST['fee_id'] . ' AND class_id=' . $_POST['class_id'] . ' AND fee_month=' . $_POST['fee_month'];
        $check_fee = query($q);
    }
    if ($check_fee == null) {
        if (empty($_POST['due_date'])) {
            $errors['due_date'] = "Date is required!";
        }
        if (empty($_POST['fee_month'])) {
            $errors['fee_month'] = "Fee ID is required!";
        } else {
            for ($i = 0; $i < count($_POST['student_id']); $i++) {
                $data = [
                    'student_id' => $_POST['student_id'][$i],
                    'fee_id' => $_POST['fee_id'],
                    'class_id' => $_POST['class_id'],
                    'fee_month' => $_POST['fee_month'],
                    'due_date' => $_POST['due_date'],
                ];
                $insert = insert('voucher', $data);
            }
            echo json_encode($insert);
            exit();
        }
    } else {
        $errors['fee'] = "Fee Voucher of selected Month and Class has already been generated!";
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['type'] == 'edit-fee-status') {

    if (empty($_POST['fee_status'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'fee_status' => $_POST['fee_status'],
            'paid_date' => $_POST['paid_date'],
        ];
        $where = 'id= ' . $_POST['status_id'];
        $update = update('voucher', $data, $where);
        echo json_encode($update);
        exit();
    }
}

if (@$_POST['type'] == 'create') {

    if (empty($_POST['class_id'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'class_id' => $_POST['class_id'],
            'monthly_fee' => $_POST['monthly_fee'],
        ];
        $insert = insert('fee', $data);
        echo json_encode($insert);
        exit();
    }
}

if (@$_POST['type'] == 'edit') {

    if (empty($_POST['class_id'])) {
        echo json_encode([
            'status' => false,
            'error' => "class is Required!",
        ]);
    } else {
        $data = [
            'class_id' => $_POST['class_id'],
            'monthly_fee' => $_POST['monthly_fee'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('fee', $data, $where);
        echo json_encode($update);
        exit();
    }
}

if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('fee', $where);
    echo json_encode($insert);
    exit();
};
