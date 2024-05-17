<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$getBook = select('quiz', '*', 'id='.$_GET['id']);

$where = 'student_id='.$_SESSION['id'] . ' AND quiz_id='.$_GET['id'] .' AND book_id='.$getBook[0]['book_id'];
$quiz = select('attempt_quiz', '*', $where);

if (@$quiz[0] > 0) {
    echo "<script>window.location.href = 'http://localhost:90/SAS/student/quiz/quiz.php?id=" . $getBook[0]['book_id'] . "';</script>";
}

$q = "SELECT quiz.*, book.name as book_name FROM quiz INNER JOIN book ON quiz.book_id = book.id where quiz.id = " . $_GET['id'] . " ";
$data = query($q);

$quiz = select('attempt_quiz', '*', 'quiz_id=' . $_GET['id'] . ' AND student_id=' . $_SESSION['id'] . '');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quiz Instruction</title>
    <link href="<?= $ROOT ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .quiz-instructions {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .quiz-instructions h2 {
            color: #333;
            margin-top: 0;
        }

        .quiz-instructions ol {
            padding-left: 20px;
        }

        .quiz-instructions ol li {
            margin-bottom: 10px;
        }

        .quiz-start-button {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="quiz-instructions">
            <h2 class="text-center">Quiz Instructions</h2>
            <p>Welcome to the online quiz! Please read the following instructions carefully:</p>
            <ol>
                <li>This quiz consists of multiple-choice questions.</li>
                <li>Each question will have only one correct answer.</li>
                <li>You must select an answer before proceeding to the next question.</li>
                <li>Once you select an answer, you cannot change it.</li>
                <li>The quiz will automatically move to the next question after 1 minute & 30 seconds, so please answer promptly.</li>
                <li>After answering last question, click the submit button to finish the quiz.</li>
            </ol>
        </div>
        <div class="text-center quiz-start-button">
            <a href="quiz-attempt.php?id=<?= $_GET['id'] ?>" class="btn btn-primary" <?= (empty($quiz)) ? '' : 'disabled' ?>>Start Quiz</a>
        </div>
    </div>
</body>

</html>

