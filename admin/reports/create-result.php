<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
$class = select('class', '*');
?>

<div class="container-fluid">
    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">Detailed Marks Certificate</h5>
        </div>
        <div class="card-body">
            <form action="process.php" method="post" id="insertForm" class="submitData" autocomplete="off">
                <input type="hidden" class="form-control" name="type" value="create">
                <div class="row justify-content-center">
                    <div class="form-group col-3">
                        <label class="font-weight-bold" for="class_id">Select Class</label>
                        <select class="form-control" name="class_id" id="class_id" required>
                            <option value="">Select Class</option>
                            <?php foreach ($class as $value) {
                                echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error class_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="form-group col-3">
                        <label class="font-weight-bold mr-3" for="studentSelect">Select Student</label>
                        <select class="form-control" name="student_id" id="studentSelect" required>
                            <option value="">Select a Student</option>
                        </select>
                        <small class="error student_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>

                    <div class="form-group col-3">
                        <label class="font-weight-bold" for="total_marks">Total Marks</label>
                        <input class="form-control" name="total_marks" id="total_marks" required>
                        <small class="error total_marks_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                </div>
                <div id="books"></div>
                <div class="modal-footer justify-content-center mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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