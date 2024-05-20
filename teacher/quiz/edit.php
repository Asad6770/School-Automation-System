<?php
require_once '../../include/function.php';
$where = 'id=' . $_GET['id'];

$data = select('quiz', '*', $where);
$row = $data[0];

$class = select('class', '*');
$class_id = 'class_id=' . $row['class_id'];
$book = select('book', '*', $class_id);
// print_r($book);
?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label class="font-weight-bold mr-3" for="class_id">Select Class</label>

        <select class="form-control" name="classID" id="classId">
            <option value="">Select Class</option>
            <?php foreach ($class as $value) {

                echo " <option value=" . $value['id'] . "";
                if ($value['id'] == $row['class_id']) {
                    echo ' selected = selected';
                }
                echo '>Class ' . $value['name'] . '</option>';
            }
            ?>
        </select>
        <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold mr-3" for="bookSelect">Select Book</label>
        <select class="form-control" name="bookSelect" id="bookSelect">
            <option value="">Select Book</option>
            <?php foreach ($book as $value) {

                echo " <option value=" . $value['id'] . "";
                if ($value['id'] == $row['book_id']) {
                    echo ' selected = selected';
                }
                echo '>' . $value['name'] . '</option>';
            }
            ?>
        </select>
        <small class="error bookSelect_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="title">Quiz Title</label>
        <input type="text" class="form-control text-capitalize" name="title" value="<?= $row['title']; ?>">
        <small class="error title_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="total_score">Total Score</label>
        <input type="text" class="form-control" name="total_score" value="<?= $row['total_score']; ?>">
        <small class="error total_score_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="due_date">Due Date</label>
        <input type="date" class="form-control" name="due_date" value="<?= $row['due_date']; ?>">
        <small class="error due_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
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