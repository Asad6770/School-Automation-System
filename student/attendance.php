<?php
require_once '../include/student-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$q = "SELECT attendance.*, class.name as class_name, book.name as book_name, teacher.fullname as teacher_name, 
student.fullname as student_name, student.username as student_id FROM attendance INNER JOIN class ON attendance.class_id = class.id 
INNER JOIN book ON attendance.book_id = book.id INNER JOIN teacher ON attendance.teacher_id = teacher.id 
JOIN student ON attendance.student_id = student.id where student_id = " . $_SESSION['id'] . " ORDER BY attendance_date DESC";

$data = query($q);

$total_days = "SELECT COUNT(*) AS student_count FROM attendance WHERE student_id =" . $_SESSION['id'] . "";
$total_days = query($total_days);
$totalWorkingDays = $total_days[0]['student_count'];

$total_present = "SELECT COUNT(*) AS student_present FROM attendance WHERE student_id =" . $_SESSION['id'] . " AND attendance_status = 'present'";
$total_present = query($total_present);
$totalPresentDays = $total_present[0]['student_present'];
if ($totalWorkingDays && $totalPresentDays > 0) {
    $percentage =  ($totalPresentDays / $totalWorkingDays) * 100;
} else {
    $percentage = '';
}

?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Attendance</h5>
            <h5 class="card-title text-center mt-4"><span class=" font-weight-bold">Attendance:</span> <?= $percentage ?> %</h5>
        </div>
        <div class="card-body">

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Student ID</th>
                            <th>Subject</th>
                            <th>Class Date</th>
                            <th>Attendance</th>
                            <th>Teacher Name</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Student ID</th>
                            <th>Subject</th>
                            <th>Class Date</th>
                            <th>Attendance</th>
                            <th>Teacher Name</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($data as $key => $value) {
                            $badge = ($value['attendance_status'] == 'present') ? 'badge-success' : 'badge-danger';
                            echo  ' <tr class="text-capitalize">
                                        <th>' . $key + 1 . '</th>
                                        <td>' . $value['student_name'] . '</td>
                                        <td class="text-uppercase">' . $value['student_id'] . '</td>
                                        <td>Class ' . $value['class_name'] . '</td>
                                        <td>' . $value['book_name'] . '</td>
                                        <td>' . date_format(new DateTime($value['attendance_date']), 'd-F-Y') . '</td>
                                        <td><span class="badge ' . $badge . '">' . $value['attendance_status'] . '</span></td>    
                                        <td>' . $value['teacher_name'] . '</td>  
                                    </tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    require_once '../include/footer.php';
    ?>