<?php
require_once '../include/teacher-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$assignment = 'SELECT submission.*, assignment.assignment_title AS title, student.fullname AS student_name,
    student.username AS student_username, book.name AS book_name, class.name AS class_name
    FROM submission INNER JOIN assignment ON assignment.id = submission.assignment_id
    INNER JOIN student ON student.id = submission.student_id INNER JOIN book ON book.id = assignment.book_id
    INNER JOIN class ON class.id = assignment.class_id where teacher_id = ' . $_SESSION['id'] . ' ';
// echo $q;
$assignments = query($assignment);

$quiz = 'SELECT attempt_quiz.*, quiz.*, class.name AS class_name, book.name AS book_name, student.fullname AS student_name       
FROM attempt_quiz 
INNER JOIN quiz ON quiz.id = attempt_quiz.quiz_id 
INNER JOIN class ON class.id = quiz.class_id 
INNER JOIN student ON student.id = attempt_quiz.student_id
INNER JOIN book ON book.id = quiz.book_id 
WHERE quiz.teacher_id = ' . $_SESSION['id'] . '';

$quizzes = query($quiz);

$q = 'SELECT * FROM salary WHERE teacher_id = ' . $_SESSION['id'] . ' AND salary_month="' . date('n') . '"';
$data = query($q);
if (@$data[0] > 0) {
    $total_salary = ($data[0]['basic_salary'] + $data[0]['allowances']);
} else {
    $total_salary = '';
}


?>

<div class="container-fluid " id="container-wrapper">
    <div class="row mb-3 d-flex flex-row align-items-center justify-content-center">
        <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Salary (Current Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-success">RS <?= $total_salary ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Submitted Assignments</div>
                            <div class="h5 mb-0 font-weight-bold text-success"><a href="assignment/submitted-assignment.php"><?= Count($assignments) ?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="font-weight-bold text-uppercase mb-1">Attempted Quizzes</div>
                            <div class="h5 mb-0 font-weight-bold text-success"><a href="quiz/attempted-quiz.php"><?= Count($quizzes) ?></a></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
require_once '../include/footer.php';
?>