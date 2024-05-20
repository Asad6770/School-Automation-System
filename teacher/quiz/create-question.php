<?php
require_once '../../include/teacher-config.php';
require_once '../../include/function.php';

$data = select('quiz', '*', 'id='.$_GET['id']);
// print_r($data);
?>

<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create-question">

    <div class="form-group">
        <label class="font-weight-bold mr-3" for="quiz_id">Select Quiz</label>
        <input class="form-control text-capitalize bg-white" value="<?= $data[0]['title'] ?>" readonly>
        <input type="hidden" name="quiz_id" value="<?= $data[0]['id'] ?>">
        <small class=" error quiz_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="question">Question Description</label>
        <input type="text" class="form-control" name="question">
        <small class="error question_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div id="dynamic-input">
        <div class="row align-items-center">
            <div class="col-11">
                <div class="form-group">
                    <label class="font-weight-bold" for="option">Options 1</label>
                    <input type="text" class="form-control" name="option[]" id="option[]" style="height: 38px;">
                </div>
            </div>
            <div>
                <button id="btn-add" class="btn btn-success btn-sm mt-3" type="button" style="height: 38px;">+</button>
            </div>
        </div>
        <small class="error option[]_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label class="font-weight-bold mr-3" for="is_correct">Select Correct Option</label>
        <select class="form-control" name="is_correct" id="is_correct">
            <option value="">Select Correct Option</option>
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <option value="<?= $i + 1 ?>">
                    Option <?= $i + 1 ?>
                </option>
            <?php endfor; ?>         
        </select>
        <small class=" error is_correct_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>

<script>
    $(document).ready(function() {
   let optionCount = 2;

$('#btn-add').click(function() {
    $('#dynamic-input').append(`
        <div class="row align-items-center option" id="option-${optionCount}">
            <div class="col-11">
                <div class="form-group">
                    <label class="font-weight-bold" for="description">Option ${optionCount++}</label>
                    <input type="text" class="form-control" name="option[]" style="height: 38px;">
                </div>
            </div>
            <div>
                <button class="btn btn-danger btn-sm mt-3 btn_remove" type="button" style="height: 38px;">X</button>
            </div>
        </div>
    `);
});

$(document).on('click', '.btn_remove', function() {
    $(this).closest('.option').remove();
    
    // Renumber the remaining options
    $('.option').each(function(index) {
        $(this).find('label').text(`Option ${index + 1}`);
    });
});

    });
</script>