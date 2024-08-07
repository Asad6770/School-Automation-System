<?php
require_once '../../include/teacher-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$q = 'SELECT quiz.*, class.name AS class_name, book.name as book_name, teacher.fullname as teacher_name       
FROM quiz INNER JOIN class ON class.id = quiz.class_id INNER JOIN teacher ON teacher.id = quiz.teacher_id
INNER JOIN book ON book.id = quiz.book_id WHERE quiz.teacher_id = ' . $_SESSION['id'] . '';
$data = query($q);
?>

<div class="container-fluid">

    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Quiz</h5>
            <button href="create.php" type="button" class="btn btn-primary btn-sm modal-load" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i>
                Create New
            </button>
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
                            <th>Total Score</th>
                            <th>Due Date</th>
                            <th>Create By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Quiz Title</th>
                            <th>Class Name</th>
                            <th>Book Name</th>
                            <th>Total Score</th>
                            <th>Due Date</th>
                            <th>Create By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $key => $value) {
                            echo  '<tr class="text-capitalize">
                                        <th>' . $key + 1 . '</th>
                                        <td>' . $value['title'] . '</td>
                                        <td>Class ' . $value['class_name'] . '</td>
                                        <td>' . $value['book_name'] . '</td>
                                        <td>' . $value['total_score'] . '</td>
                                        <td>' . date_format(new DateTime($value['due_date']), 'd-F-Y') . '</td>
                                        <td>' . $value['teacher_name'] . '</td>
                                        <td>
                                        <a class="text-white btn btn-info btn-sm modal-load" href="create-question.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Question</a> |
                                            <a class="text-white btn btn-success btn-sm modal-load" href="edit.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a> |
                                            <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="'
                                . $value['id'] . '">Delete</a>        
                                        </td>
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
require_once '../../include/footer.php';
?>