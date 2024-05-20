<?php 
require_once '../../include/admin-config.php';
require_once '../../include/function.php';
$where = 'id=' . $_GET['id'];

$data = select('class', '*', $where);
$row = $data[0];
$name = $row['name'];
?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">
    
    <div class="form-group">
        <label for="name">Class</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>">
        <small class="error name_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>