<?php
require_once '../include/student-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$q = 'SELECT course_selection.*, book.name AS book_name FROM course_selection INNER JOIN book ON book.id = course_selection.book_id
WHERE course_selection.student_id = ' . $_SESSION['id'] . '';
$data = query($q);


?>
<div class="row mx-5">
    <?php
    if (@$data > 0) {
        foreach ($data as $value) {
            $where = "due_date >'" . date('Y-m-d') . "' AND " . "book_id =" . $value['book_id'];
            $notifications_quiz = select('quiz', 'due_date', $where);
            $notifications_assignment = select('assignment', 'due_date', $where);
    ?>

            <div class="col-4 mb-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="font-weight-bold text-uppercase"><?= $value['book_name'] ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-center">
                                <img src="<?= $ROOT ?>assets/upload/assignment.png" width="70" height="70" alt="">
                                <hr>
                                <a class="font-weight-bold text-decoration-none text-dark" href="
                                        <?= $ROOT . 'student/assignment/assignment.php?id=' . $value['book_id'] . '' ?>">Assignment</a>
                                <span class="<?= (count($notifications_assignment) != 0) ? 'badge badge-danger badge-counter' : '' ?>">
                                    <?= (count($notifications_assignment) != 0) ? count($notifications_assignment) : '' ?></span>
                            </div>
                            <div class="col-4 text-center">
                                <img src="<?= $ROOT ?>assets/upload/quiz.png" width="70" height="70" alt="">
                                <hr>
                                <a class="font-weight-bold text-decoration-none text-dark" href="
                                        <?= $ROOT . 'student/quiz/quiz.php?id=' . $value['book_id'] . '' ?>">Quiz</a>
                                <span class="<?= (count($notifications_quiz) != 0) ? 'badge badge-danger badge-counter' : '' ?>">
                                    <?= (count($notifications_quiz) != 0) ? count($notifications_quiz) : '' ?></span>
                            </div>
                            <div class="col-4 text-center">
                                <img src="<?= $ROOT ?>assets/upload/lecture.png" width="70" height="70" alt="">
                                <hr>
                                <a class="font-weight-bold text-decoration-none text-dark" href="
                                        <?= $ROOT . 'student/lectures/current-lecture.php?id=' . $value['book_id'] . '' ?>"> Lectures</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>
<?php
require_once '../include/footer.php';
?>