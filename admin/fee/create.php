<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';

$data = select('class', '*');
?>
<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label class="font-weight-bold" for="class_id">Class</label>
        <select class="form-control" name="class_id" id="class_id">
            <option>Select Class</option>
            <?php foreach ($data as $value) {

                echo '<option value="' . $value['id'] . '" class="text-capitalize">class ' . $value['name'] . '</option>';
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label class="font-weight-bold" for="monthly_fee">Monthly Fee</label>
        <input type="text" class="form-control" name="monthly_fee" id="monthly_fee" required>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>