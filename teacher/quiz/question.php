<?php
require_once '../../include/teacher-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$q = 'SELECT questions.*, quiz.title AS quiz_title FROM questions INNER JOIN quiz ON quiz.id = questions.quiz_id
WHERE quiz.teacher_id = ' . $_SESSION['id'] . '';
$data = query($q);
// print_r($data);
?>

<div class="container-fluid">

    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Questions</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Quiz Title</th>
                            <th>Question Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Quiz Title</th>
                            <th>Question Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($data as $value) {
                            @$index += 1;
                            echo '<tr class="text-capitalize">
                                    <td>' . $index . '</td>
                                    <td>' . $value['quiz_title'] . '</td>
                                    <td>' . $value['question'] . '</td>
                                    <td>
                                        <a class="text-white btn btn-info btn-sm" href="view.php?id='
                                . $value['id'] . '">View</a> |
                                            <a class="text-white btn btn-success btn-sm modal-load" href="edit-question.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal" id ="edit">Edit</a> |
                                            <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="'
                                . $value['id'] . '">Delete</a>        
                                    </td>
                                </tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
require_once '../../include/footer.php';
?>