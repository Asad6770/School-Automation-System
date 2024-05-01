<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';



if (@$_POST['type'] == 'create') {

    $errors = [];

    if (empty($_POST['quiz_id'])) {
        $errors['quiz_id'] = "Quiz Field is Required!";
    }

    if (empty($_POST['question'])) {
        $errors['question'] = "Question Field is Required!";
    }
    if (empty($_POST['correct_option'])) {
        $errors['correct_option'] = "Correct Option Field is Required!";
    }
    if (empty($_POST['is_correct'])) {
        $errors['is_correct'] = "Correct Option Field is Required!";
    } else {
        $question = $_POST['question'];
        $quiz_id = $_POST['quiz_id'];
        $correct = $_POST['is_correct'];
        $sql = "INSERT INTO questions (quiz_id, question) VALUES ('$quiz_id', '$question')";
        $conn->query($sql);
        $question_id = $conn->insert_id;

        for ($i = 0; $i < count($_POST['option']); $i++) {
            $is_correct = ($i + 1 == $correct) ? 1 : 0;
            $data = [
                'option' => $_POST['option'][$i],
                'question_id' =>  $question_id,
                'is_correct' => $is_correct,
            ];
            $insert = insert('options', $data);
        }
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['type'] == 'edit') {

    $errors = [];

    if (empty($_POST['quiz_id'])) {
        $errors['quiz_id'] = "Quiz Field is Required!";
    }

    if (empty($_POST['question'])) {
        $errors['question'] = "Question Field is Required!";
    }
    if (empty($_POST['correct_option'])) {
        $errors['correct_option'] = "Correct Option Field is Required!";
    }
    if (empty($_POST['is_correct'])) {
        $errors['is_correct'] = "Correct Option Field is Required!";
    } else {
        $question = $_POST['question'];
        $quiz_id = $_POST['quiz_id'];
        $correct = $_POST['is_correct'];
        $id = $_POST['id'];
        $sql = "UPDATE questions SET quiz_id = '$quiz_id', question = '$question' WHERE id = $id";
        // print_r($sql);
        // exit();
        $conn->query($sql);
        for ($i = 0; $i < count($_POST['option']); $i++) {
            $is_correct = ($i +1 == $correct) ? 1 : 0;
            $where = 'id= ' . $_POST['option_id'][$i];
            $data = [
                'option' => $_POST['option'][$i],
                'is_correct' => $is_correct,
            ];
            $update = update('options', $data, $where);
        }
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['id']) {
    $where = 'id=' . $_POST['id'];
    $insert = delete('questions', $where);
    echo json_encode($insert);
    exit();
};
