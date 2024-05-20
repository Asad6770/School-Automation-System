<?php require_once '../../include/admin-config.php'; ?>
<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create-parent">

    <div class="form-group">
        <label class="font-weight-bold" for="name">Fullname</label>
        <input type="text" class="form-control" name="fullname" id="fullname" required>
        <small class="error fullname_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="form-group">
        <label class="font-weight-bold" for="name">Phone No</label>
        <input type="text" class="form-control" name="phone_no" id="phone_no" required>
        <small class="error phone_no_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>