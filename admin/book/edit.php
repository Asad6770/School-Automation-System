<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$where = 'id=' . $_GET['id'];

$data = select('book', '*', $where);

$class = select('class', '*');

?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData" autocomplete="off">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">

    <div class="form-group">
        <label for="class_id">Class</label>
        
        <select class="form-control" name="class_id" id="class_id">
            <option value="">Select Class</option>
            <?php foreach ($class as $value) {

                echo ' <option value=' . $value['id'];
                if ($value['id'] == $data[0]['class_id']) {
                    echo 'selected = selected';
                }
                echo '>' . $value['name'] . '</option>';
            }
            ?>
        </select>
        <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="form-group">
        <label for="name">Class</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $row['name']; ?>">
    </div>

    <div class="form-group">
        <label class="font-weight-bold" for="selection_type">Type</label>
        <select class="form-control" name="selection_type" id="selection_type">
            <option value=""></option>
            <option value="require" <?php if ($row['selection_type'] == "require") {
                                        echo 'selected = selected';
                                    }
                                    ?>>Require</option>
            <option value="elective" <?php if ($row['selection_type'] == "elective") {
                                            echo 'selected = selected';
                                        }
                                        ?>>Elective</option>
        </select>
        <small class="error selection_type_error text-danger font-weight-bold" style="font-size: 15px;"></small>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>