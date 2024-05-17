<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$getBook = select('quiz', '*', 'id='.$_GET['id']);

$where = 'student_id='.$_SESSION['id'] . ' AND quiz_id='.$_GET['id'] .' AND book_id='.$getBook[0]['book_id'];
$quiz = select('attempt_quiz', '*', $where);

if (@$quiz[0] > 0) {
    echo "<script>window.location.href = 'http://localhost:90/SAS/student/quiz/quiz.php?id=" . $getBook[0]['book_id'] . "';</script>";
}

$where = 'quiz_id=' . $_GET['id'];
$questions = select('questions', '*', $where);
// print_r($questions[0]['id']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Online Quiz</title>
    <link href="<?= $ROOT ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= $ROOT ?>assets/css/dashboard.css" rel="stylesheet">
    <script src="<?= $ROOT ?>assets/vendor/jquery/jquery.min.js"></script>
</head>

<body>
    <div id="quiz"></div>
    <div class="container text-center mt-3">
        <button id="submit" class="btn btn-primary">Submit</button>
    </div>
    <script>
        var currentQuiz = <?= $_GET['id'] ?>;
        var currentQuestion = <?= $questions[0]['id'] ?>;
        var timer;

        function loadQuestion() {
            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: {
                    quiz_number: currentQuiz,
                    question_number: currentQuestion
                },
                success: function(response) {
                    $('#quiz').html(response);
                    startTimer();
                }
            });
        }

        function startTimer() {
            var timeLeft = 90; // 90 seconds
            clearInterval(timer);
            timer = setInterval(function() {
                timeLeft--;
                $('#timer').text(timeLeft);
                if (timeLeft <= 0) {
                    submitAnswer();
                }
            }, 1000); // 1 second
        }

        function submitAnswer() {
            var answer = $('input[name="answer"]:checked').val();
            console.log(answer);
            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: {
                    type: 'attempt',
                    question_number: currentQuestion,
                    answer: answer
                },
                success: function(response) {
                    currentQuestion++;
                    loadQuestion();
                }
            });
        }

        $(document).ready(function() {
            loadQuestion();
            $('#submit').click(function() {
                console.log("Button clicked")
                submitAnswer();
            });
        });
    </script>