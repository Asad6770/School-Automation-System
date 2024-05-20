<?php
require_once '../../include\admin-config.php';
require_once '../../include\header.php';
require_once '../../include\function.php';

$data = select('admin', '*');
?>

<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">Course Selection (Enable & Disable)</h5>
        </div>
        <div class="card-body">
            <form action="process.php" method="post" class="submitData" autocomplete="off">
                <input type="hidden" class="form-control" name="type" value="edit">
                <input type="hidden" class="form-control" name="id" value=" <?= $data[0]['id'] ?>">
                <div class="row justify-content-center">
                    <div class="form-group col-4">
                        <label class="font-weight-bold" for="course_selection">Course Selection Status</label>
                        <select class="form-control" name="course_selection" id="course_selection">
                            <option value="enable" <?= ($data[0]['course_selection'] == 'enable') ? 'selected' : '' ?>>Enable</option>
                            <option value="disable" <?= ($data[0]['course_selection'] == 'disable') ? 'selected' : '' ?>>Disable</option>

                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    require_once '../../include/footer.php';
    ?>