<?php
require_once 'C:\xampp\htdocs\SAS\include\teacher-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$q = 'SELECT attempt_quiz.*, quiz.*, class.name AS class_name, book.name AS book_name, student.fullname AS student_name       
FROM attempt_quiz 
INNER JOIN quiz ON quiz.id = attempt_quiz.quiz_id 
INNER JOIN class ON class.id = quiz.class_id 
INNER JOIN student ON student.id = attempt_quiz.student_id
INNER JOIN book ON book.id = quiz.book_id 
WHERE quiz.teacher_id = ' . $_SESSION['id'] . '';

$data = query($q);
// print_r($data);
?>

<div class="container-fluid">
    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Attempted Quizzes</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Quiz Title</th>
                            <th>Class Name</th>
                            <th>Book Name</th>
                            <th>Student</th>
                            <th>Total Marks</th>
                            <th>Obtained Marks</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Quiz Title</th>
                            <th>Class Name</th>
                            <th>Book Name</th>
                            <th>Student</th>
                            <th>Total Marks</th>
                            <th>Obtained Marks</th>
                            <th>Date & Time</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $value) {
                            @$index += 1;
                            echo  ' 
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['title'] . '</td>
                                        <td>Class ' . $value['class_name'] . '</td>
                                        <td>' . $value['book_name'] . '</td>
                                        <td>' . $value['student_name'] . '</td>
                                        <td>' . $value['total_score'] . '</td>
                                        <td>' . $value['score'] . '</td>
                                        <td>' . date_format(new DateTime($value['dateTime']), 'd-F-Y h-i-s') . '</td>
                                    </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>