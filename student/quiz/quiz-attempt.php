<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'quiz_id=' . $_GET['id'];
$questions = select('questions', '*', $where);
// print_r($questions[0]['id']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Online Quiz</title>
    <link href="<?= $ROOT ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $ROOT ?>/assets/css/dashboard.css" rel="stylesheet">
    <script src="<?= $ROOT ?>/assets/vendor/jquery/jquery.min.js"></script>
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
            // console.log('hello ' + currentQuestion);
            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: {
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