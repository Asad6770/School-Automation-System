
<?php require_once '../../include/admin-config.php'; ?>
<form action="process.php" method="post"  class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label for="name">Class</label>
        <input type="text" class="form-control" name="name" id="name">
        <small class="error name_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>