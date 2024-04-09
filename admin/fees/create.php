<?php
include_once '../function.php';

$data = select('class', '*');
?>
<form action="process.php" method="post" id="insertForm" class="submitData">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label for="fk_class_id">Class</label>
        <select class="form-control" name="fk_class_id" id="fk_class_id">
            <option>Select Class</option>
            <?php foreach ($data as $value) {

                echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="fee_amount">Fee Amount</label>
        <input type="text" class="form-control" name="fee_amount" id="fee_amount" required>
    </div>
    
    <div class="form-group">
        <label for="due_date ">Due Date</label>
        <input type="date" class="form-control" name="due_date " id="due_date" required>
    </div>

</form>