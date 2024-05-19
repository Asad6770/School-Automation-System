<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];
$lecture = select('lectures', '*', $where);

$class = select('class', '*');
$book = select('book', '*');
?>

<form action="process.php" method="post" class="submitData" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label class="font-weight-bold mr-3" for="classId">Select Class</label>
        <select class="form-control" name="class_id" id="classId">
            <option value="">Select Class</option>
            <?php foreach ($class as $value) {
                echo '<option value="' . $value['id'] . '"';
                if ($value['id'] == $lecture[0]['class_id']) {
                    echo 'selected = selected';
                }
                echo '>Class ' . $value['name'] . '</option>';
            }
            ?>
        </select>
        <small class=" error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label class="font-weight-bold mr-3" for="bookSelect">Select Book</label>
        <select class="form-control" name="bookSelect" id="bookSelect">
            <option value="">Select Book</option>
            <?php foreach ($book as $value) {
                echo '<option value="' . $value['id'] . '"';
                if ($value['id'] == $lecture[0]['book_id']) {
                    echo 'selected = selected';
                }
                echo '>' . $value['name'] . '</option>';
            }
            ?>

        </select>
        <small class="error bookSelect_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="lecture_no">Lecture No</label>
        <input type="text" class="form-control" name="lecture_no" value="<?= $lecture[0]['lecture_no'] ?>">
        <small class="error lecture_no_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="lecture_title">Lecture Title</label>
        <input type="text" class="form-control" name="lecture_title" value="<?= $lecture[0]['lecture_title'] ?>">
        <small class="error lecture_title_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="lecture">Lecture</label>
        <input class="form-control" name="lecture" id="lecture" type="file">
        <small class="error lecture_error text-danger font-weight-bold" style="font-size: 15px;"></small>
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