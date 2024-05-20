<?php
require_once '../../include/function.php';
$where = 'id=' . $_GET['id'];

$data = select('teacher_attendance', '*', $where);
$teacher_id = 'id=' . $data[0]['teacher_id'];
$teacher = select('teacher', '*', $teacher_id);
?>

<form action="process.php" method="post" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">
    <div class="form-group">
        <label for="class_id">Teacher Name</label>
        <input type="text" class="form-control bg-white" value="<?= $teacher[0]['fullname'] ?>" readonly>
    </div>
    <div class="form-group">
        <label for="name">Class</label>
        <select class="form-control" name="attendance_status" id="attendance_status">
            <option value="1" <?= ($data[0]['attendance_status'] == '1') ? 'selected' : '' ?> >Present</option>
            <option value="0" <?= ($data[0]['attendance_status'] == '0') ? 'selected' : '' ?>>Absent</option>
        </select>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>