<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$class = select('class', '*');
$book = select('book', '*');
$q = 'SELECT dmc.*, book.name AS book_name FROM dmc INNER JOIN book ON book.id = dmc.book_id WHERE student_id=  ' . $_GET['student_id'];
$dmc = query($q);
?>

<div class="container-fluid">
    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">Detailed Marks Certificate</h5>
        </div>
        <div class="card-body">
            <form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
                <input type="hidden" class="form-control" name="type" value="edit">
                <div class="row justify-content-center">
                    <div class="form-group col-3">
                        <?php if (@$dmc[0] > 0) {
                            echo '<label class="font-weight-bold" for="class_id">Select Class</label>
                                            <select class="form-control" name="class_id" id="class_id" required>
                                            <option value="">Select Class</option>';
                            $student = select('student', '*', 'class_id=' . $dmc[0]['class_id']);
                            foreach ($class as $value) {
                                echo '<option value="' . $value['id'] . '"';
                                if ($value['id'] == $dmc[0]['class_id']) {
                                    echo ' selected = selected';
                                }
                                echo '>Class ' . $value['name'] . '</option>';
                            }
                        ?>
                            </select>
                            <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="form-group col-3">
                        <label class="font-weight-bold mr-3" for="studentSelect">Select Student</label>
                        <select class="form-control" name="student_id" id="studentSelect" required>
                            <option value="">Select a Student</option>
                            <?php foreach ($student as $value) {
                                echo '<option value="' . $value['id'] . '"';
                                if ($value['id'] == $dmc[0]['class_id']) {
                                    echo ' selected = selected';
                                }
                                echo '>' . $value['fullname'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error student_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="form-group col-3">
                        <label class="font-weight-bold" for="total_marks">Total Marks</label>
                        <input class="form-control" name="total_marks" id="total_marks" required value="<?= $dmc[0]['total_marks'] ?>">
                        <small class="error total_marks_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                </div>
                <div id="books">
                    <?php foreach ($dmc as $key => $value) { ?>
                        <input type="hidden" class="form-control" name="id[]" id="id" value="<?= $dmc[$key]['id'] ?>">
                        <div class="row justify-content-center">
                            <div class="form-group col-4">
                                <label class="font-weight-bold mr-3" for="book_id">Book Name</label>
                                <input type="hidden" class="form-control" name="book_id[]" id="book_id" value="<?= $dmc[$key]['book_id'] ?>">
                                <input class="form-control bg-white" value="<?= $dmc[$key]['book_name'] ?>" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label class="font-weight-bold" for="obtained_marks">Obtained Marks</label>
                                <input class="form-control" name="obtained_marks[]" id="obtained_marks" value="<?= $dmc[$key]['obtained_marks'] ?>">
                                <small class="error obtained_marks_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </div>
                        </div>

                <?php  }

                            echo '
                                    </div>
                                    <div class="modal-footer justify-content-center mt-2">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>';
                        } else {
                            echo '<div class="text-center font-weight-bold mb-1">No data available</div>';
                        } ?>
            </form>
        </div>
    </div>
</div>




<?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>

<script>
    $(document).ready(function() {
        $('#class_id').change(function() {
            var classId = $(this).val();
            console.log(classId);
            $.ajax({
                type: 'GET',
                url: 'process.php',
                data: {
                    class_id: classId
                },
                success: function(response) {
                    $('#studentSelect').html(response);
                }
            });
        });

        $('#studentSelect').change(function() {
            var studentId = $(this).val();
            console.log(studentId);
            $.ajax({
                type: 'GET',
                url: 'process.php',
                data: {
                    student_id: studentId
                },
                success: function(response) {
                    $('#books').html(response);
                }
            });
        });
    });
</script>