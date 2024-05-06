<?php 
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];

$data = select('assignment', '*', $where);

$class = select('class', '*');
$book = select('book', '*', 'class_id='.$data[0]['class_id']);
?>
<form action="process.php" method="post" class="submitData">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="row justify-content-center">
        <div class="col-6">
            <label class="font-weight-bold mr-3" for="classId">Select Class</label>
            <select class="form-control" name="classId" id="classId">
                <option value="">Select Class</option>
                <?php
                 foreach ($class as $value) {
                    echo ' <option value=' . $value['id'];
                    if ($value['id'] == $data[0]['class_id']) {
                        echo 'selected = selected';
                    }
                    echo '>' . $value['name'] . '</option>';
                }
                ?>
            </select>
            <small class=" error classId_error text-danger font-weight-bold" style="font-size: 15px;"></small>
        </div>
        <div class="col-6">
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
    </div>

    <div class="row justify-content-center">
        <div class="col-6">
            <label class="font-weight-bold" for="total_score">Total Score</label>
            <input class="form-control" type="text" name="total_score" id="total_score">
            <small class="error total_marks_error text-danger font-weight-bold" style="font-size: 15px;"></small>
        </div>
        <div class="col-6">
            <label class="font-weight-bold" for="due_date">Due Date</label>
            <input class="form-control" type="date" name="due_date" id="due_date">
            <small class="error due_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <label class="font-weight-bold" for="assignment_title">Assignment Title</label>
            <input class="form-control" type="text" name="assignment_title" id="assignment_title">
            <small class="error assignment_title_error text-danger font-weight-bold" style="font-size: 15px;"></small>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 mt-4">
            <label class="font-weight-bold" for="question">Assignment Question</label>
            <textarea class="form-control" name="question" id="question"></textarea>
            <small class="error question_error text-danger font-weight-bold" style="font-size: 15px;"></small>
        </div>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>

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
</script>