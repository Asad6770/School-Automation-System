<?php
require_once '../function.php';
$where = 'id=' . $_GET['id'];

$data = select('parent', '*', $where);
$row = $data[0];
?>

<form action="process.php" method="post" id="insertForm" class="submitData">
    <input type="hidden" class="form-control" name="type" value="edit-parent">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">
    <div class="form-group">
        <label for="name">Fullname</label>
        <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $row['fullname']; ?>" required>
    </div>
    <div class="form-group">
        <label for="name">Phone No</label>
        <input type="text" class="form-control" name="phone_no" id="phone_no" value="<?= $row['phone_no']; ?>" required>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>