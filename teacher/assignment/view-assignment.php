<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];

$data = select('submission', '*', $where);
$row = $data[0];

// print_r($data);

?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="submission-edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

    
    <div class="form-group">
        <label for="name">Answer</label>
        <p><?= $row['answer']; ?></p>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="score">Marks</label>
        <input type="text" class="form-control" name="score" value="<?= $row['score'] ?>">
        <small class="error selection_type_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>