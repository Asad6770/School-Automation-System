<?php
require_once '../../include/teacher-config.php';
require_once '../../include/function.php';

if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $date = $_POST['attendance_date'];
} else {
    $data = [];
}
require_once '../../include/header.php';

$class = select('class', '*');
$book = select('book', '*');
?>
<div class="container-fluid">
    <div class="card mb-4">
        <div class="row py-3 justify-content-center">
            <div class="input-group-sm col-3">
                <label class="font-weight-bold mr-3" for="classId">Select Class</label>
                <select class="form-control" name="class_id" id="classId" required>
                    <option value="">Select Class</option>
                    <?php foreach ($class as $value) {
                        echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="card">
        <div class="card-header justify-content-center mt-4">
            <h5 class="card-title font-weight-bold text-left">List of Attendance Report</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Class</th>
                            <th>Percentage (%)</th>
                        </tr>
                    </thead>
                    <tbody id="student">
                        <div ></div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../../include/footer.php';
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
                    $('#student').html(response);
                }
            });
        });
    });
</script>