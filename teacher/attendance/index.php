<?php
require_once '../function.php';
session_start();

if (isset($_POST['fk_class_id'])) {
    $class_id = $_POST['fk_class_id'];
    $q = 'SELECT student.*, class.name 
    as class_name 
    FROM student 
    INNER JOIN class 
    ON student.fk_class_id = class.id
    where fk_class_id = "' . $class_id . '"';
    $data = query($q);
} else {
    $class_id = '';
    
    $data = 0;
}


if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "tc") {
        echo "<div 
        style='position: fixed; top: 50%; left: 50%;
        transform: translate(-50%, -50%); 
        background-color: #f44336;
        color: white; padding: 20px;
        font-size: 20px;
        '>
        Access Denied
    </div>";
    } else {
        require_once '../include/header.php';
        $class = select('class', '*');
        $subject = select('subject', '*');
?>
        <div class="container-fluid">
            <div class="card mb-4">
                <form action="" method="POST">
                    <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-center">
                        <select class="form-control col-3 text-uppercase" name="fk_class_id" id="fk_class_id">
                            <option value="">Select Class</option>
                            <?php
                            foreach ($class as $value) {
                                echo ' <option value=' . $value['id'];
                                if ($value['id'] == @$class_id) {
                                    echo 'selected = selected';
                                }
                                echo '>' . $value['name'] . '</option>';
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
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center font-weight-bold">Attendance Mark Form</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <form action="process.php" method="post" class="submitData">
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
                                    foreach ($data as $value) {
                                        @$index += 1;
                                        echo  ' 
                                            <tr class="text-capitalize">
                                                <td> ' . $index . '</td>
                                                <td>
                                                <input type="text" value=' . $value['id'] . ' name="student_id[]" hidden>'
                                            . $value['fullname'] . '
                                                </td>
                                                <td class="text-uppercase">' . $value['username'] . '</td>
                                                <td class="justify-content-center"> 
                                                    <select class="" name="attendance_status[]" id="status">
                                                        <option>Select Class</option>
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <input type="text" value=' . $class_id . ' name="class_id" hidden>
                                            ';
                                    }
                                } else {
                                    echo  '
                                    <tr class="text-capitalize">
                                        <td colspan = "4">no data found</td>  
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <hr class="sidebar-divider">
                    <div class="d-flex flex-row input-group-sm align-items-center justify-content-center">
                        <select class="form-control col-2 mr-3  text-uppercase" name="subject_id" id="subject_id">
                            <option value="">Select Subject</option>
                            <?php
                            foreach ($subject as $value) {
                                echo ' <option value=' . $value['id'];
                                if ($value['id'] == "") {
                                    echo 'selected = selected';
                                }
                                echo '>' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Save Attendance
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once '../include/footer.php';
?>