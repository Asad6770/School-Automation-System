<?php
require_once '../../include/student-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$q = "SELECT quiz.*, book.name as book_name FROM quiz INNER JOIN book ON quiz.book_id = book.id where book_id = " . $_GET['id'] . " ";
// echo $q;
$data = query($q);
// print_r($data);
?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List Of Quizzes</h5>
        </div>
        <div class="card-body">

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Title</th>
                            <th>Due Date</th>
                            <th>Total Marks</th>
                            <th>Submit</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($data as $key => $value) {
                            $q = "SELECT attempt_quiz.* from attempt_quiz where quiz_id = " . $value['id']
                                . " AND student_id = " . $_SESSION['id'] . "";
                            $check_value = query($q);
                            // print_r($check_value);
                            $status = (@$check_value[0]['student_id'] != null) ? 'Submitted'
                                : (($value['due_date'] < date('Y-m-d')) ? 'Expired' : '<a href="'
                                    . $ROOT . '/student/quiz/quiz-instruction.php?id=' . $value['id'] . '">Take Quiz</a>');

                            $badge = (@$check_value[0]['student_id'] != null) ? 'text-success' : '';
                            echo  ' <tr class="text-capitalize">
                                        <th>' . $key + 1 . '</th>
                                        <td>' . $value['title'] . '</td>
                                        <td class="text-uppercase">'  . date_format(new DateTime($value['due_date']), 'd-F-Y') . '</td>
                                        <td>' . $value['total_score'] . '</td>
                                        <td class=' . $badge . '>' . $status . '</td>
                                        <td>' . @$check_value[0]['score'] . '</td>  
                                    </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    require_once '../../include/footer.php';
    ?>