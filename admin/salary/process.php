<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';

if (@$_POST['type'] == 'create-salary') {

    $errors = [];
    if (empty($_POST['teacher_id'])) {
        $errors['teacher_id'] = "Name is Required!";
    }

    if (empty($_POST['salary_month'])) {
        $errors['salary_month'] = "Salary Amount is Required!";
    }

    if (empty($_POST['basic_salary'])) {
        $errors['basic_salary'] = "Basic Salary Amount is Required!";
    }

    if (empty($_POST['allowances'])) {
        $errors['allowances'] = "Allowances is Required!";
    } else {

        $data = [
            'teacher_id' => $_POST['teacher_id'],
            'salary_month' => $_POST['salary_month'],
            'basic_salary' => $_POST['basic_salary'],
            'allowances' => $_POST['allowances'],
        ];
        // print_r($data);
        // exit();
        $insert = insert('salary', $data);
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['type'] == 'edit-salary') {

    $errors = [];
    if (empty($_POST['teacher_id'])) {
        $errors['teacher_id'] = "Name is Required!";
    }

    if (empty($_POST['salary_month'])) {
        $errors['salary_month'] = "Salary Amount is Required!";
    }

    if (empty($_POST['basic_salary'])) {
        $errors['basic_salary'] = "Basic Salary Amount is Required!";
    }

    if (empty($_POST['allowances'])) {
        $errors['allowances'] = "Allowances is Required!";
    } else {
        $data = [
                'teacher_id' => $_POST['teacher_id'],
                'salary_month' => $_POST['salary_month'],
                'basic_salary' => $_POST['basic_salary'],
                'allowances' => $_POST['allowances'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('salary', $data, $where);
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}

if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('salary', $where);
    echo json_encode($insert);
};
