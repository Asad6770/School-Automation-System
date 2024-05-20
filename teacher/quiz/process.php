<?php
require_once '../../include/function.php';
session_start();
if (isset($_GET['class_id'])) {
    $where = 'class_id=' . $_GET['class_id'];
    $data = select('book', '*', $where);

    if (count($data) > 0) {
        $output = '<option value="">Select a Book</option>';
        foreach ($data as $value) {
            $output .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
    } else {
        $output = '<option value="">Select a Book</option>';
        $output .= '<option>No Books Found</option>';
    }
    echo $output;
}


if (@$_POST['type'] == 'create') {

    $errors = [];

    if (empty($_POST['classId'])) {
        $errors['classId'] = "Class Field is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book Field is Required!";
    }
    if (empty($_POST['title'])) {
        $errors['title'] = "Quiz Title Field is Required!";
    } 
    if (empty($_POST['total_score'])) {
        $errors['total_score'] = "Score Field is Required!";
    }
    if (empty($_POST['due_date'])) {
        $errors['due_date'] = "Date Field is Required!";
    }
    else {
        $data = [
            'class_id' => $_POST['classId'],
            'book_id' => $_POST['bookSelect'],
            'title' => $_POST['title'],
            'total_score' => $_POST['total_score'],
            'due_date' => $_POST['due_date'],
            'teacher_id' => $_SESSION['id'],
        ];
        $insert = insert('quiz', $data);
        echo json_encode($insert);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


if (@$_POST['type'] == 'edit') {

    $errors = [];

    if (empty($_POST['classId'])) {
        $errors['classId'] = "Class Field is Required!";
    }

    if (empty($_POST['bookSelect'])) {
        $errors['bookSelect'] = "Book Field is Required!";
    }
    if (empty($_POST['title'])) {
        $errors['title'] = "Quiz Title Field is Required!";
    } 
    if (empty($_POST['total_score'])) {
        $errors['total_score'] = "Score Field is Required!";
    }
    if (empty($_POST['due_date'])) {
        $errors['due_date'] = "Date Field is Required!";
    } else {
        $data = [
            'class_id' => $_POST['classID'],
            'book_id' => $_POST['bookSelect'],
            'title' => $_POST['title'],
            'total_score' => $_POST['total_score'],
            'due_date' => $_POST['due_date'],
        ];
        $where = 'id= ' . $_POST['id'];
        $update = update('quiz', $data, $where);
        echo json_encode($update);
        exit();
    }
    $data = ['status' => empty($errors), 'error' => $errors];
    echo json_encode($data);
    exit();
}


// if (@$_POST['id']) {
//     $where = 'id=' . $_POST['id'];
//     $insert = delete('quiz', $where);
//     echo json_encode($insert);
//     exit();
// };

if (@$_POST['type'] == 'create-question') {

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

if (@$_POST['type'] == 'edit-question') {

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
        $id = $_POST['ques_id'];
        $sql = "UPDATE questions SET quiz_id = '$quiz_id', question = '$question' WHERE id = $id";
        // print_r($sql);
        // exit();
        $conn->query($sql);
        for ($i = 0; $i < count($_POST['option']); $i++) {
            $is_correct = ($i + 1 == $correct) ? 1 : 0;
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
    $where = 'question_id=' . $_POST['id'];
    $options = select('options', '*', $where);
    foreach ($options as $option) {
        $where = 'id=' . $option['id'];
        $optionDelete = delete('options',  $where);
    }
    $question = 'id=' . $_POST['id'];
    $delete = delete('questions', $question);
    echo json_encode($delete);
    exit();
};