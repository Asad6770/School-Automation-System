<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$data = select('class', '*');
?>

<form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="create">

    <div class="form-group">
        <label for="name">Subject</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>