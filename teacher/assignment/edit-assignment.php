<?php
require_once 'C:\xampp\htdocs\SAS\include\teacher-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];

$data = select('assignment', '*', $where);

$class = select('class', '*');
$book = select('book', '*', 'class_id=' . $data[0]['class_id']);
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center font-weight-bold mt-4">Create Assignment</h5>
        </div>
        <div class="card-body">
            <form action="process.php" method="post" class="submitData">
                <input type="hidden" class="form-control" name="type" value="edit">
                <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

                <div class="row justify-content-center">
                    <div class="col-3">
                        <label class="font-weight-bold mr-3" for="classId">Select Class</label>
                        <select class="form-control" name="classId" id="classId">
                            <option value="">Select Class</option>
                            <?php
                            foreach ($class as $value) {
                                echo ' <option value=' . $value['id'];
                                if ($value['id'] == $data[0]['class_id']) {
                                    echo 'selected = selected';
                                }
                                echo '>Class ' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class=" error classId_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="col-3">
                        <label class="font-weight-bold mr-3" for="bookSelect">Select Book</label>
                        <select class="form-control" name="bookSelect" id="bookSelect">
                            <option value="">Select Book</option>
                            <?php foreach ($book as $value) {
                                echo " <option value=" . $value['id'] . "";
                                if ($value['id'] == $data[0]['book_id']) {
                                    echo ' selected = selected';
                                }
                                echo '>' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error bookSelect_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="col-2">
                        <label class="font-weight-bold" for="total_score">Total Score</label>
                        <input class="form-control" type="text" name="total_score" id="total_score" value="<?= $data[0]['total_score'] ?>">
                        <small class="error total_marks_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="col-2">
                        <label class="font-weight-bold" for="due_date">Due Date</label>
                        <input class="form-control" type="date" name="due_date" id="due_date" value="<?= $data[0]['due_date'] ?>">
                        <small class="error due_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="col-2">
                        <label class="font-weight-bold" for="assignment_title">Assignment Title</label>
                        <input class="form-control" type="text" name="assignment_title" id="assignment_title" value="<?= $data[0]['assignment_title'] ?>">
                        <small class="error assignment_title_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="col-12">
                        <label class="font-weight-bold" for="question">Assignment Question</label>
                        <textarea class="form-control" name="question" id="edit-question"><?= $data[0]['question'] ?></textarea>
                        <small class="error edit-question_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <a type="button" href="<?= $ROOT ?>/teacher/assignment/create-assignment.php" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </form>
        </div>
    </div>

    <?php
    require_once 'C:\xampp\htdocs\SAS\include\footer.php';
    ?>

    <script>
        $(document).ready(function() {
            $('#classId').change(function() {
                var classId = $(this).val();
                console.log(classId);
                $.ajax({
                    type: 'GET',
                    url: 'process.php',
                    data: {
                        class_id: classId
                    },
                    success: function(response) {
                        $('#bookSelect').html(response);
                    }
                });
            });
        });

        ClassicEditor
            .create(document.querySelector('#edit-question'))
            .catch(error => {
                console.error(error);
            });
    </script>