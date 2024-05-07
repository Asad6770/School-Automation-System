<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

session_start();
if (isset($_POST['quiz_number'])) {
    $quizNumber = $_POST['quiz_number'];
    $questionNumber = $_POST['question_number'];
    if ($questionNumber) {
        if (!isset($_SESSION['questionNumber'])) {
            $_SESSION['questionNumber'] = 1;
        } else {
            $_SESSION['questionNumber']++;
        }
    }
    
    $quiz = select('quiz', '*', 'id=' . $quizNumber);

    $_SESSION['quiz_id'] = $quiz[0]['id'];
    $_SESSION['book_id'] = $quiz[0]['book_id'];

    $question = 'SELECT * FROM questions WHERE quiz_id = ' . $quizNumber . ' AND id = ' . $questionNumber . '';
    $questions = query($question);
    $total_question = count(select('questions', '*', 'quiz_id=' . $quizNumber));

    $displayQuestionNumber = $questionNumber % 10;
    if ($_SESSION['questionNumber'] == 11) {
        unset($_SESSION['questionNumber']);
        echo '<script>window.location.href = "' . $ROOT . '/student/quiz/quiz-finished.php";</script>';
        exit();
    } else {
        @$output .='<div class="card justify-content-center">
                <div class="container mt-5 mb-5">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <div> <span class="font-weight-bold">Student ID: </span> <small class="ms-3">'. $_SESSION['username'] .'</small> </div>
                        <div> <span class="font-weight-bold">Student Name: </span> <small class="ms-3">'.$_SESSION['fullname'].'</small> </div>
                        <div> <span class="font-weight-bold">Quiz No: </span> <small class="ms-3">'.$_SESSION['quiz_Id'] .'='. $_GET['id'].'</small> </div>
                        <div> <span class="font-weight-bold">Time Left: </span> <small class="ms-3" id="timer">90</small> </div>
                    </div>
                </div>
            </div>';

        @$output .= '<div class="container mb-2">
        <label class="pt-4"><b>Question No:- ' . $_SESSION['questionNumber'] . ' of ' . $total_question . '</b><span class="ml-3 text-capitalize">' . $questions[0]['question'] . '</span> </label>
        
        </div>';
        $option = "SELECT * FROM options WHERE question_id = " . $questions[0]['id'] . "";
        $options = query($option);

        foreach ($options as $answer) {
            $output .= '
            <div class="container input-group mb-2">
                <span class="input-group-text" id="basic-addon1">
                    <input type="radio" name="answer" value="' . $answer['id'] . '">
                </span>
                <input type="text" class="form-control bg-light" value="' . $answer['option'] . '" readonly>
            </div>';
        }
        
        echo $output;
    }
}


if (isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    $question = $_POST['question_number'];
    $check_is_correct = select('options', '*', 'question_id=' . $question . ' AND id=' . $answer);
    if ($check_is_correct[0]['is_correct'] == '1') {
        if (!isset($_SESSION['count'])) {
            $_SESSION['count'] = 1;
        } else {
            $_SESSION['count']++;
        }
    }
    if ($question) {
        if (!isset($_SESSION['question'])) {
            $_SESSION['question'] = 1;
        } else {
            $_SESSION['question']++;
        }
    }
    if ($_SESSION['question'] == 10) {

        $data = [
            'student_id' => $_SESSION['id'],
            'score' => $_SESSION['count'],
            'quiz_id' => $_SESSION['quiz_id'],
            'book_id' => $_SESSION['book_id'],
        ];
        insert('attempt_quiz', $data);
        unset($_SESSION['count'], $_SESSION['question'], $_SESSION['quiz_id'], $_SESSION['book_id']);
    }
}
