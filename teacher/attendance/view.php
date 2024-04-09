<?php
require_once '../function.php';
session_start();

if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $q = "SELECT attendance.*,
    class.name as class_name, 
    subject.name as subject_name, 
    teacher.fullname as teacher_name, 
    student.fullname as student_name,
    student.username as student_id
    FROM attendance 
    INNER JOIN class ON attendance.class_id = class.id 
    INNER JOIN subject ON attendance.subject_id = subject.id 
    INNER JOIN teacher ON attendance.teacher_id = teacher.id 
    JOIN student ON attendance.student_id = student.id
    where class_id = ".$_POST['class_id']." AND
    subject_id = ".$_POST['subject_id']." 
    ";
    $data = query($q);
} 
else 
{
    $class_id = '';
    $subject_id = '';
    $q = 'SELECT attendance.*,
    class.name as class_name, 
    subject.name as subject_name, 
    teacher.fullname as teacher_name, 
    student.fullname as student_name,
    student.username as student_id
    FROM attendance 
    INNER JOIN class ON attendance.class_id = class.id 
    INNER JOIN subject ON attendance.subject_id = subject.id 
    INNER JOIN teacher ON attendance.teacher_id = teacher.id 
    JOIN student ON attendance.student_id = student.id';
    $data = query($q);
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
                    <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-around">
                        <select class="form-control col-3 text-uppercase" name="class_id" id="class_id" required>
                            <option value="">Select Class</option>
                            <?php
                            foreach ($class as $value) {
                                echo ' <option value=' . $value['id'];
                                if ($value['id'] == @$subject_id) {
                                    echo 'selected = selected';
                                }
                                echo '>' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>

                        <select class="form-control col-3 text-uppercase" name="subject_id" id="subject_id" required>
                            <option value="">Select subject</option>
                            <?php
                            foreach ($subject as $value) {
                                echo ' <option value=' . $value['id'];
                                if ($value['id'] == @$class_id) {
                                    echo 'selected = selected';
                                }
                                echo '>' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>

                        <!-- <input type="date" class="form-control col-3" name="attendance_date" id="attendance_date" required/> -->

                        <button href="process.php" type="submit" class="btn btn-primary btn-sm ml-3">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                        </form>
                        <a href="<?= $ROOT ?>/teacher/attendance/view.php" class="btn btn-primary btn-sm ml-3">
                            <i class="fas fa-eye"></i>
                            View All
                        </a>
                    </div>
                
            </div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h5 class="card-title text-center">Attendance Form</h5>
                </div>

                <div class="card-body">
                <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Create By</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                foreach (@$data as $value) {
                                   $badge = ($value['status'] == 'present') ? 'badge-success' : 'badge-danger';
                                    @$index += 1;
                                    echo  ' <tr class="text-capitalize">
                                    <td>' . $index . '</td>
                                    <td>' . $value['student_name'] . '</td>
                                    <td>' . $value['student_id'] . '</td>
                                    <td>' . $value['class_name'] . '</td>
                                    <td>' . $value['subject_name'] . '</td>
                                    <td>' . $value['attendance_date'] . '</td>
                                    <td><span class="badge '.$badge.'">' . $value['status'] . '</span></td>
                                    <td>' . $value['teacher_name'] . '</td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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