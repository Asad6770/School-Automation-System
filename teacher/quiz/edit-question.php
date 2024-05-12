<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];

$data = select('questions', '*', $where);
$row = $data[0];

$quiz = select('quiz', '*', 'id=' . $row['quiz_id']);
$question_id = 'question_id=' . $row['id'];
$options = select('options', '*', $question_id);
// print_r($row );

?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" name="type" value="edit-question">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label for="quiz_id">Quiz</label>
        <input class="form-control text-capitalize" value="<?= $quiz[0]['title'] ?>" readonly>
        <input type="hidden" name="quiz_id" value="<?= $row['quiz_id'] ?>">
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="question">Question Description</label>
        <input type="text" class="form-control" name="question" value="<?= $row['question']; ?>">
        <small class="error description_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <?php foreach ($options as $key => $value) { ?>
        <input type="hidden" name="option_id[]" value="<?= $value['id']; ?>">
        <div class="form-group">
            <label class="font-weight-bold" for="option">Option <?= $key + 1 ?></label>
            <input type="text" class="form-control" name="option[]" value="<?= $value['option']; ?>">
            <small class="error total_score_error text-danger font-weight-bold" style="font-size: 15px;"></small>
        </div>
    <?php } ?>

    <div class="form-group">
        <label class="font-weight-bold mr-3" for="is_correct">Select Correct Option</label>
        <select class="form-control" name="is_correct" id="is_correct">
            <option value="">Select Correct Option</option>
            <?php for ($i = 0; $i < count($options); $i++) : ?>
                <option value="<?= $i + 1 ?>" <?= $options[$i]['is_correct'] == '1' ? 'selected' : '' ?>>
                    Option <?= $i + 1 ?>
                </option>
            <?php endfor; ?>
        </select>
        <small class=" error is_correct_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>