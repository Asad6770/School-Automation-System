<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$where = 'id=' . $_GET['id'];
$data = select('lecture_schedule', '*', $where);
$row = $data[0];

$class = select('class', '*');
$class_id = 'class_id=' . $row['class_id'];
$book = select('book', '*', $class_id);
$teacher = select('teacher', '*');

?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">Create Lectures Schedule</h5>
        </div>
        <div class="card-body">
            <form method="post" action="process.php" class="submitData" autocomplete="off">
                <input type="hidden" class="form-control" name="type" value="edit">
                <input type="hidden" class="form-control" name="id" value="<?= $_GET['id'] ?>">
                <div class="row">
                    <div class="form-group col-4">
                        <label class="font-weight-bold mr-3" for="class_id">Select Class</label>
                        <select class="form-control" name="classID" id="classId">
                            <option value="">Select Class</option>
                            <?php foreach ($class as $value) {

                                echo " <option value=" . $value['id'] . "";
                                if ($value['id'] == $row['class_id']) {
                                    echo ' selected = selected';
                                }
                                echo '>Class ' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="form-group col-4">
                        <label class="font-weight-bold mr-3" for="bookSelect">Select Book</label>
                        <select class="form-control" name="bookSelect" id="bookSelect">
                            <option value="">Select Book</option>
                            <?php foreach ($book as $value) {

                                echo " <option value=" . $value['id'] . "";
                                if ($value['id'] == $row['book_id']) {
                                    echo ' selected = selected';
                                }
                                echo '>' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error bookSelect_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="form-group col-4">
                        <label class="font-weight-bold" for="lecture_date">Date</label>
                        <input type="date" name="lecture_date" class="form-control" id="lecture_date" value="<?= $row['lecture_date'] ?>" required />
                        <small class="error lecture_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="form-group col-4">
                        <label class="font-weight-bold" for="start_time">Start Time</label>
                        <select name="start_time" class="form-control">
                            <option value="">Select Start Time</option>
                            <?php
                            $current_time = date('H:i', strtotime($row['start_time']));
                            for ($i = 7; $i <= 16; $i++) {
                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                $option_time = $hour . ':00';
                                echo '<option value="' . $option_time . '"';
                                if ($option_time == $current_time) {
                                    echo ' selected="selected"';
                                }
                                echo '>' . $option_time . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error start_time_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="form-group col-4">
                        <label class="font-weight-bold" for="end_time">End Time</label>
                        <select name="end_time" class="form-control">
                            <option value="">Select Start Time</option>
                            <?php
                            $current_time = date('H:i', strtotime($row['end_time']));
                            for ($i = 7; $i <= 16; $i++) {
                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                $option_time = $hour . ':00';
                                echo '<option value="' . $option_time . '"';
                                if ($option_time == $current_time) {
                                    echo ' selected="selected"';
                                }
                                echo '>' . $option_time . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error end_time_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="form-group col-4">
                        <label class="font-weight-bold" for="teacher_id">Teacher</label>
                        <select class="form-control" name="teacher_id" id="teacher_id" required>
                            <option value="">Select Teacher</option>
                            <?php foreach ($teacher as $value) {

                                echo ' <option value=' . $value['id'];
                                if ($value['id'] == $row['teacher_id']) {
                                    echo 'selected = selected';
                                }
                                echo '>' . $value['fullname'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error teacher_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="text-center col-12">
                        <a type="button" href="<?= $ROOT ?>/admin/lecture-schedule/create-schedule.php" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>
<script>
    $(document).ready(function() {
        $('#classId').change(function() {
            var classId = $(this).val();
            console.log(classId);
            $.ajax({
                type: 'GET',
                url: 'process.php',
                data: {
                    class_id: classId
                },
                success: function(response) {
                    $('#bookSelect').html(response);
                }
            });
        });
    });
</script>