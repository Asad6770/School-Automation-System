<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: ../not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';

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
            where student_id = " . $_SESSION['id'] . " ";

        $data = query($q);
?>

        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h5 class="card-title text-center mt-4 font-weight-bold">Attendance Report</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Teacher Name</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Teacher Name</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php

                                foreach ($data as $value) {
                                    $badge = ($value['attendance_status'] == 'present') ? 'badge-success' : 'badge-danger';
                                    @$index += 1;
                                    echo  ' 
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['student_name'] . '</td>
                                        <td>' . $value['student_id'] . '</td>
                                        <td>' . $value['subject_name'] . '</td>
                                        <td>' . date_format(new DateTime($value['attendance_date']), 'd-F-Y') . '</td>
                                        <td><span class="badge ' . $badge . '">' . $value['attendance_status'] . '</span></td>    
                                        <td>' . $value['teacher_name'] . '</td>  
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    <?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>