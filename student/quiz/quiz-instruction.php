<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\function.php';
        $q = "SELECT quiz.*,
        book.name as book_name
        FROM quiz 
        INNER JOIN book ON quiz.book_id = book.id 
        where quiz.id = " . $_GET['id'] . " ";
        $data = query($q);
        // print_r($data);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Quiz Instruction</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- Custom CSS -->
            <style>
                /* Add custom styles here */
                body {
                    padding-top: 40px;
                    padding-bottom: 40px;
                    background-color: #f5f5f5;
                }

                .container {
                    max-width: 600px;
                }

                .quiz-instructions {
                    margin-bottom: 20px;
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
                        <li>The quiz will automatically move to the next question after one minute, so please answer promptly.</li>
                        <li>After answering all questions, click the submit button to finish the quiz.</li>
                    </ol>
                </div>
                <div class="text-center">
                    <a href="quiz-attempt.php?id=<?=$_GET['id']?>" class="btn btn-primary">Start Quiz</a>
                </div>
            </div>
        </body>

        </html>


<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}

?>

<script>
    ClassicEditor
        .create(document.querySelector('#answer'))
        .catch(error => {
            console.error(error);
        });
</script>