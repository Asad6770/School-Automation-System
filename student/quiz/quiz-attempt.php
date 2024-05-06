<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\function.php';
        $where = 'quiz_id=' . $_GET['id'];
        $questions = select('questions', '*', $where);
        // print_r($questions);
        $data = [];
        foreach ($questions as $question) {
            $data[] = $question['id'];
        }
        json_encode($data);
?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>Online Quiz</title>
            <link href="<?= $ROOT ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link href="<?= $ROOT ?>/assets/css/dashboard.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </head>

        <body>
            <?php
            ?>

            <div class="card justify-content-center">
                <div class="container mt-5 mb-5">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <div> <span class="font-weight-bold">Student ID: </span> <small class="ms-3"><?= $_SESSION['username'] ?></small> </div>
                        <div> <span class="font-weight-bold">Student Name: </span> <small class="ms-3"><?= $_SESSION['fullname'] ?></small> </div>
                        <div> <span class="font-weight-bold">Quiz No: </span> <small class="ms-3"><?= $_SESSION['quiz_Id'] = $_GET['id'] ?></small> </div>
                        <div> <span class="font-weight-bold">Time Left: </span> <small class="ms-3" id="timer">90</small> </div>
                    </div>
                </div>
            </div>
            <div id="quiz"></div>
            <div class="container text-center mt-3">
                <button id="submit" class="btn btn-primary">Submit</button>
            </div>
            <script>
                var currentQuiz = <?= $_GET['id'] ?>;
                var currentQuestion = null;
                var timer;

                function loadQuestion() {
                    $.ajax({
                        url: 'process.php',
                        type: 'POST',
                        data: {
                            question_number: currentQuestion
                        },
                        success: function(response) {
                            $('#quiz').html(response);
                            startTimer();
                        }
                    });
                }

                function startTimer() {
                    var timeLeft = 90; // 60 seconds
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
                    $.ajax({
                        url: 'process.php',
                        type: 'POST',
                        data: {
                            question_number: currentQuestion,
                            answer: answer
                        },
                        success: function(response) {
                            // if (response == 'success') {
                            currentQuestion++;
                            loadQuestion();
                            // } else {
                            //     alert('Failed to submit answer. Please try again.');
                            // }
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

    <?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
    ?>