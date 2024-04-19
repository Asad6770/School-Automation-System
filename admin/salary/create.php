<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$data = select('teacher', '*');
?>
<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create-salary">

    <div class="form-group">
        <label class="font-weight-bold" for="teacher_id">Class</label>
        <select class="form-control" name="teacher_id" id="teacher_id" >
            <option value="">Select Teacher</option>
            <?php foreach ($data as $value) {

                echo '<option value="' . $value['id'] . '" class="text-capitalize">' . $value['fullname'] . '</option>';
            }
            ?>
        </select>
        <small class="error teacher_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="salary_month">Salary Month</label>
        <select class="form-control" name="salary_month" id="salary_month" >
            <option value="">Select Month</option>
            <option value="january">January</option>
            <option value="february">February</option>
            <option value="march">March</option>
            <option value="april">April</option>
            <option value="may">May</option>
            <option value="june">June</option>
            <option value="july">July</option>
            <option value="august">August</option>
            <option value="september">September</option>
            <option value="cctober">October</option>
            <option value="november">November</option>
            <option value="december">December</option>
        </select>
        <small class="error salary_month_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="basic_salary">Basic Salary</label>
        <input type="text" class="form-control" name="basic_salary" id="basic_salary" >
        <small class="error basic_salary_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="allowances">Allowances</label>
        <input type="text" class="form-control" name="allowances" id="allowances" >
        <small class="error allowances_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>