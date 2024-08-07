<?php 
require_once '../../include/admin-config.php';
require_once '../../include/function.php';
$where = 'id=' . $_GET['id'];

$data = select('teacher', '*', $where);
$row = $data[0];

?>

<form action="teacher-process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">
    <div class="form-group">
        <label for="name">Fullname</label>
        <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $row['fullname']; ?>" required>
        <small class="error fullname_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label for="name">Phone No</label>
        <input type="text" class="form-control" name="phone_no" id="phone_no" value="<?= $row['phone_no']; ?>" required>
        <small class="error phone_no_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label for="name">Address</label>
        <input type="text" class="form-control" name="address" id="address" value="<?= $row['address']; ?>" required>
        <small class="error address_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>