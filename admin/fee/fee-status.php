<?php
require_once '../../include/function.php';
$where = 'id=' . $_GET['id'];

//calling select function
$data = select('voucher', '*', $where);

?>
<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit-fee-status">
    <input type="hidden" class="form-control" name="status_id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label class="font-weight-bold" for="fee_status">Fee Status</label>
        <select class="form-control" name="fee_status" id="fee_status">
            <option value="unpaid" <?php
                                    if ($data[0]['fee_status'] == 'unpaid' ) {
                                        echo 'selected = selected';
                                    }
                                    ?>>Unpaid</option>
            <option value="paid" <?php
                                    if ($data[0]['fee_status'] == 'paid') {
                                        echo 'selected = selected';
                                    }
                                    ?>>Paid</option>
        </select>
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="monthly_fee">Fee Paid Date</label>
        <input class="form-control" type="date" name="paid_date" id="paid_date" value="<?= $data[0]['paid_date'] ?>">
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>