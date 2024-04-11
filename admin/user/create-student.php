<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$data = select('class', '*');
?>

<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create-student">

    <div class="form-group">
        <label for="name">Fullname</label>
        <input type="text" class="form-control" name="fullname" id="fullname" required>
    </div>
    <div class="form-group">
        <label for="name">Phone No</label>
        <input type="text" class="form-control" name="phone_no" id="phone_no" required>
    </div>
    <div class="form-group">
        <label for="name">Address</label>
        <input type="text" class="form-control" name="address" id="address" required>
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

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>