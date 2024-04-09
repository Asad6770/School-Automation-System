<?php
require_once '../function.php';
session_start();

if (isset($_GET['fk_class_id'])) {
    $class_id = $_GET['fk_class_id'];
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
    JOIN student ON attendance.student_id = student.id
    
    ';
    $data = query($q);
// print_r($data);
// exit();



} else {
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
                <form action="" method="get">
                    <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-around">
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

                        <select class="form-control col-3 text-uppercase" name="fk_class_id" id="fk_class_id">
                            <option value="">Select Class</option>
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

                        <input type="date" class="form-control col-3" name="date" id="date"/>

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
                    <h5 class="card-title text-center">Attendance Form</h5>
                </div>

                <div class="card-body">
                <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Class</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Create By</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                foreach (@$data as $value) {
                                    @$index += 1;
                                    echo  ' <tr class="text-capitalize">
                                    <td>' . $index . '</td>
                                    <td>' . $value['student_name'] . '</td>
                                    <td>' . $value['student_id'] . '</td>
                                    <td>' . $value['class_name'] . '</td>
                                    <td>' . $value['date'] . '</td>
                                    <td>' . $value['status'] . '</td>
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