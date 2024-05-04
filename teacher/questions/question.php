<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "tc") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {

        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';

        $q = 'SELECT questions.*, quiz.title AS quiz_title
        FROM questions INNER JOIN quiz ON quiz.id = questions.quiz_id
        WHERE quiz.teacher_id = '.$_SESSION['id'].'';
        $data = query($q);
        // print_r($data);
?>

        <div class="container-fluid">

            <div class="card input-group-sm mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h5 class="card-title text-center mt-4 font-weight-bold">List of Questions</h5>
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
                                <?php
                                foreach ($data as $value) {
                                    @$index += 1;
                                    echo  ' 
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['quiz_title'] . '</td>
                                        <td>' . $value['question'] . '</td>
                                        <td>
                                        <a class="text-white btn btn-info btn-sm" href="view.php?id='
                                        . $value['id'] . '">View</a> |
                                            <a class="text-white btn btn-success btn-sm modal-load" href="edit.php?id='
                                        . $value['id'] . '"data-toggle="modal" data-target="#exampleModal" id ="edit">Edit</a> |
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
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>