<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create-parent">

    <div class="form-group">
        <label for="name">Fullname</label>
        <input type="text" class="form-control" name="fullname" id="fullname" required>
    </div>
    <div class="form-group">
        <label for="name">Phone No</label>
        <input type="text" class="form-control" name="phone_no" id="phone_no" required>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>