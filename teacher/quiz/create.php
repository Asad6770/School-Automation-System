<?php
require_once '../../include/function.php';

$data = select('class', '*');
?>

<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label class="font-weight-bold mr-3" for="classId">Select Class</label>
        <select class="form-control" name="classId" id="classId">
            <option value="">Select Class</option>
            <?php foreach ($data as $value) {
                echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
            }
            ?>
        </select>
        <small class=" error classId_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label class="font-weight-bold mr-3" for="bookSelect">Select Book</label>
        <select class="form-control" name="bookSelect" id="bookSelect">
            <option value="">Select Book</option>
        </select>
        <small class="error bookSelect_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="title">Quiz Title</label>
        <input type="text" class="form-control" name="title" >
        <small class="error title_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="total_score">Total Score</label>
        <input type="text" class="form-control" name="total_score" >
        <small class="error total_score_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="due_date">Due Date</label>
        <input type="date" class="form-control" name="due_date" >
        <small class="error due_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
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