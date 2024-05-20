<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';
$where = 'id=' . $_GET['id'];
$class = select('class', '*');
$fee = select('fee', '*', $where);


?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label class="font-weight-bold" for="class_id">Class</label>
        <select class="form-control" name="class_id" id="class_id">
            <option>Select Class</option>
            <?php foreach ($class as $value) {
                echo ' <option class="text-capitalize" value=' . $value['id'];
                if ($value['id'] == $fee[0]['class_id'] ) {
                    echo 'selected = selected';
                }
                echo '>Class ' . $value['name'] . '</option>';
            }
            ?>
        </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="monthly_fee">Monthly Fee</label>
            <input type="text" class="form-control" name="monthly_fee" id="monthly_fee" value="<?= $fee[0]['monthly_fee'] ?>" required>
        </div>

        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

</form>