<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$data = select('class', '*');
?>

<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label class="font-weight-bold" for="fk_class_id">Class</label>
        <select class="form-control" name="class_id" id="class_id">
            <option value="">Select Class</option>
            <?php foreach ($data as $value) {

                echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
            }
            ?>
        </select>
        <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="name">Book Name</label>
        <input type="text" class="form-control" name="name" id="name">
        <small class="error name_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="selection_type">Type</label>
        <select class="form-control" name="selection_type" id="selection_type">
            <option value=""></option>
            <option value="require">Require</option>
            <option value="elective">Elective</option>
        </select>
        <small class="error selection_type_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>