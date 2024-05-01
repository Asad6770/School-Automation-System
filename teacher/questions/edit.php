<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];

$data = select('questions', '*', $where);
$row = $data[0];

$quiz = select('quiz', '*');
$question_id = 'question_id=' . $row['id'];
$options = select('options', '*', $question_id);

?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label for="quiz_id">Select Quiz</label>

        <select class="form-control" name="quiz_id" id="quiz_id">
            <option value="">Select Class</option>
            <?php foreach ($quiz as $value) {

                echo $value['id'] . " <option value=" . $value['id'] . "";
                if ($value['id'] == $row['quiz_id']) {
                    echo ' selected = selected';
                }
                echo '>' . $value['title'] . '</option>';
            }
            ?>
        </select>
        <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="description">Question Description</label>
        <input type="text" class="form-control" name="description" value="<?= $row['question']; ?>">
        <small class="error description_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <?php foreach ($options as $key => $value) { ?>
        <div class="form-group">
            <label class="font-weight-bold" for="correct_option">Option <?= $key + 1 ?></label>
            <input type="text" class="form-control" name="correct_option[]" value="<?= $value['option']; ?>">
            <small class="error total_score_error text-danger font-weight-bold" style="font-size: 15px;"></small>
        </div>
    <?php } ?>

    <div class="form-group">
        <label class="font-weight-bold mr-3" for="is_correct">Select Correct Option</label>
        <select class="form-control" name="is_correct" id="is_correct">
            <option value="">Select Correct Option</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="4">Option 4</option>
        </select>
        <small class=" error is_correct_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>