<?php
include_once '../function.php';

$data = select('class', '*');
?>

<form action="process.php" method="post" id="insertForm" class="submitData">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label for="name">Subject</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>