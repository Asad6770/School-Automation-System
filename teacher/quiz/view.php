<?php
require_once 'C:\xampp\htdocs\SAS\include\teacher-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$q = 'SELECT options.*, questions.question AS question_description FROM options INNER JOIN questions ON 
questions.id = options.question_id WHERE options.question_id = ' . $_GET['id'] . '';
$data = query($q);
// print_r($data);
// exit();
?>

<div class="container-fluid">
    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Question & Answers</h5>
            <a href="<?= $ROOT ?>/teacher/quiz/question.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Question Description</th>
                            <th>Options</th>
                            <th>Correct Option</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Question Description</th>
                            <th>Options</th>
                            <th>Correct Option</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $value) {
                            @$index += 1;
                            echo  ' 
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['question_description'] . '</td>
                                        <td>' . $value['option'] . '</td>
                                        <td>' . $is_correct = ('1' == $value['is_correct']) ? 'Correct' : '-' . '</td>
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