<?php
require_once 'C:\xampp\htdocs\SAS\config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

session_start();
if(isset($_POST['question_number'])){
    $questionNumber = $_POST['question_number'];

    // Fetch question from database
    $question = 'SELECT * FROM questions WHERE id = '.$questionNumber.'';
    $questions = query($question);
    echo $question;
    // Fetch answers for the question from database
    $option = "SELECT * FROM options WHERE question_id = $questionNumber";
    $options = query($option);
    
    // Prepare HTML for the question and answers
    
    @$output .= '<div class="container input-group mb-2">
    <label class="container font-weight-bold pt-4">Question No:- '. $questionNumber.' of 10 </label>
    <label class="container text-capitalize">' . $questions[0]['question'] . '</label>
    </div>';
    foreach ($options as $answer) {
        $output .= '
        <div class="container input-group mb-2">
            <span class="input-group-text" id="basic-addon1"><input type="radio" name="answer" value="' . $answer['id'] . '"></span>
            <input type="text" class="form-control" value="' . $answer['option'] . '" readonly>
        </div>';
    }
    
    echo $output;
}

if(isset($_POST['answer'])){
    $answer = $_POST['answer'];

    echo $answer;
}

