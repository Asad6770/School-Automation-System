<?php
require_once '../../include/admin-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$data = select('teacher', '*');
?>
<div class="container-fluid">

    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Teachers</h5>
        </div>
        <div class="card-body">
        <div class="text-center">
                <small class="error status_error text-danger font-weight-bold text-center" style="font-size: 15px;"></small>
            </div>
            <form action="process.php" method="post" class="submitData" autocomplete="off">
                <input type="hidden" class="form-control" name="type" value="create">
                <div class="row text-center justify-content-center">
                        <div class="form-group col-3">
                            <label class="font-weight-bold" for="teacher_id">Teacher</label>
                        </div>
                        <div class="form-group col-2">
                            <label class="font-weight-bold" for="name">Status</label>
                        </div>
                    </div>
                <?php foreach ($data as $key => $value) { ?>
                    <div class="row justify-content-center">
                        <div class="form-group col-3 d-flex align-items-center">
                            <input type="hidden" value="<?= $value['id'] ?>" name="teacher_id[]" id="teacher_id">
                            <input type="text" class="form-control bg-white" value="<?= $value['fullname'] ?>" readonly>
                            <small class="error teacher_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                        </div>

                        <div class="form-group col-2">
                            <select class="form-control" name="attendance_status[]" id="attendance_status">
                                <option value="">Select Status</option>
                                <option value="1">Present</option>
                                <option value="2">Absent</option>

                            </select>
                            <small class="error attendance_status_<?= $key ?>_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                        </div>
                    </div>
                <?php } ?>
                <div class="row justify-content-center">
                    <div class="form-group col-3 ">
                        <label class="font-weight-bold" for="attendance_date">Date</label>
                        <input type="date" class="form-control"  name="attendance_date" id="attendance_date">
                        <small class="error attendance_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                </div>
                <div class="text-center">
                    <a href="<?= $ROOT ?>/admin/attendance/teacher-attendance.php" class="btn btn-secondary">Close</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once '../../include/footer.php';
?>