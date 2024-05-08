<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$data = select('class', '*');
?>

<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create-student">

    <div class="form-group">
        <label for="name">Fullname</label>
        <input type="text" class="form-control" name="fullname" id="fullname" >
        <small class="error fullname_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label for="father_name">Father Name</label>
        <input type="text" class="form-control" name="father_name" id="father_name" >
        <small class="error father_name_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label for="name">Phone No</label>
        <input type="text" class="form-control" name="phone_no" id="phone_no" >
        <small class="error phone_no_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label for="name">Address</label>
        <input type="text" class="form-control" name="address" id="address" >
        <small class="error address_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label for="class_id">Class</label>
        <select class="form-control" name="class_id" id="class_id">
            <option value="">Select Class</option>
            <?php foreach ($data as $value) {

                echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
            }
            ?>
        </select>
        <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>