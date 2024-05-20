<?php
require_once '../../include/teacher-config.php';
require_once '../../include/function.php';
if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $q = 'SELECT student.*, class.name as class_name 
    FROM student 
    INNER JOIN class ON student.class_id = class.id
    where class_id = "' . $class_id . '"';
    $data = query($q);
} else {
    $class_id = '';
    $data = 0;
}
require_once '../../include/header.php';

$class = select('class', '*');
if (isset($data[0]['class_id'])) {
    $book = select('book', '*', "class_id =" . $data[0]['class_id']);
}
?>
<div class="container-fluid">
    <div class="card mb-4">
        <form action="" method="POST">
            <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-center">
                <label class="font-weight-bold  mr-3" for="attendance_date">Class: </label>
                <select class="form-control col-3 text-uppercase" name="class_id" id="class_id">
                    <option value="">Select Class</option>
                    <?php
                    foreach ($class as $value) {
                        echo ' <option value=' . $value['id'];
                        if ($value['id'] == @$class_id) {
                            echo 'selected = selected';
                        }
                        echo '>Class ' . $value['name'] . '</option>';
                    }
                    ?>
                </select>
                <button href="process.php" type="submit" class="btn btn-primary btn-sm ml-3">
                    <i class="fas fa-search"></i>
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center font-weight-bold">Take Attendance</h5>
        </div>

        <div class="card-body">
            <div class="text-center">
            <small class="error attendance_error text-danger font-weight-bold" style="font-size: 15px;"></small>
            </div>
            <div class="text-danger">
                <strong>Note: </strong><label>Please verify all students. Once attendance is saved, it can't be changed.</label>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <form action="process.php" method="post" class="submitData">
                            <input type="hidden" value='take-attendance' name="type">
                            <tr>
                                <th>S No</th>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Status</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (@$data > 0) {
                            foreach ($data as $key => $value) {
                               
                                echo  ' <tr class="text-capitalize">
                                            <td> ' . $key + 1 . '</td>
                                            <td>
                                                <input type="text" value=' . $value['id'] . ' name="student_id[]" hidden>
                                                ' . $value['fullname'] . '
                                            </td>
                                            <td class="text-uppercase">
                                                ' . $value['username'] . '
                                            </td>
                                            <td class="justify-content-center"> 
                                                <select class="border-0 bg-transparent" name="attendance_status[]" id="status">
                                                    <option value="">Select Status</option>
                                                    <option value="present">Present</option>
                                                    <option value="absent">Absent</option>
                                                </select>
                                                <small class="error attendance_status_' . $key . '_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                                            </td>
                                        </tr>
                                            <input type="text" value=' . $class_id . ' name="class_id" hidden>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex flex-row input-group-sm align-items-center justify-content-center">
                <?php if ($data != null) { ?>
                    <div class="col-2">
                        <label class="font-weight-bold" for="attendance_date">Date: </label>
                        <input class="form-control" type="date" name="attendance_date" id="attendance_date">
                        <small class="error attendance_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="col-2">
                        <label class="font-weight-bold" for="book_id">Book: </label>
                        <select class="form-control text-uppercase" name="book_id" id="book_id">
                            <option value="">Select Book</option>
                            <?php
                            foreach ($book as $value) {
                                echo ' <option value=' . $value['id'];

                                echo '>' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <small class="error book_id_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                    </div>
                    <div class="col-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            Save Attendance
                        </button>
                    </div>

            </div>
        <?php   } else {
                    echo '<div class="text-center font-weight-bold col-12">No data available in table</div>';
                }  ?>
        </form>
        </div>
    </div>
</div>
<?php
require_once '../../include/footer.php';
?>