<?php
include_once '../function.php';

$data = select('class', '*');
?>

<form action="process.php" method="post" id="insertForm" class="submitData">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label for="name">Subject</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>
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

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>