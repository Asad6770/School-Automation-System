<?php 
require_once '../function.php';
$where = 'id=' . $_GET['id'];

$data = select('subject', '*', $where);
$row = $data[0];
$class = select('class', '*');
$id = $data[0]['fk_class_id'];
?>

<form action="process.php" method="post" enctype="multipart/form-data" class="submitData">
    <input type="hidden" class="form-control" name="type" value="edit">
    <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">
    
    <div class="form-group">
        <label for="name">Class</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $row['name']; ?>">
    </div>
    <div class="form-group">
        <label for="fk_class_id">Class</label>
        
        <select class="form-control" name="fk_class_id" id="fk_class_id">
            <option>Select Class</option>
            <?php foreach ($class as $value) {

                echo ' <option value=' . $value['id'];
                if ($value['id'] == $id) {
                    echo 'selected = selected';
                }
                echo '>' . $value['name'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="exampleModal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>