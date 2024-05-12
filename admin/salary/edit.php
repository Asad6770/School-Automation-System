<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];
$data = select('teacher', '*');
$salary = select('salary', '*', $where);

?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit-salary">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label class="font-weight-bold" for="teacher_id">Class</label>
        <select class="form-control" name="teacher_id" id="teacher_id">
            <option value="">Select Teacher</option>
            <?php foreach ($data as $value) {

                echo ' <option value=' . $value['id'];
                if ($value['id'] == $salary[0]['teacher_id']) {
                    echo 'selected = selected';
                }
                echo '>' . $value['fullname'] . '</option>';
            }
            ?>
        </select>
        <small class="error teacher_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="salary_month">Salary Month</label>
        <select class="form-control" name="salary_month" id="salary_month">
            <option value="">Select Month</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $month = date('F', mktime(0, 0, 0, $i, 1));
               
                echo '<option value="' . $i . '"';
                if ($i == $salary[0]['salary_month']) {
                    echo ' selected="selected"';
                }
                echo '>' . $month . '</option>';
            }
            ?>
        </select>
        <small class="error salary_month_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="basic_salary">Basic Salary</label>
        <input type="text" class="form-control" name="basic_salary" id="basic_salary" value="<?= $salary[0]['basic_salary'] ?>">
        <small class="error basic_salary_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="allowances">Allowances</label>
        <input type="text" class="form-control" name="allowances" id="allowances" value="<?= $salary[0]['allowances'] ?>">
        <small class="error allowances_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>