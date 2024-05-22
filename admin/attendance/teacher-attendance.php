<?php
require_once '../../include/admin-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$q = 'SELECT teacher_attendance.*, teacher.fullname AS teacher_name FROM teacher_attendance INNER JOIN teacher ON teacher.id = teacher_attendance.teacher_id
ORDER BY id DESC';
$data = query($q);
?>

<div class="container-fluid">

    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Teachers Attendance Record</h5>
            <a href="<?= $ROOT ?>/admin/attendance/create.php" type="button" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                Take Attendance
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Teacher Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Teacher Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $key => $value) {
                            $status = ($value['attendance_status'] == '1') ? 'Present' : 'Absent';
                            $badge = ($value['attendance_status'] == '1') ? 'badge-success' : 'badge-danger';
                            echo  ' 
                                    <tr class="text-capitalize">
                                        <th>' . $key + 1 . '</th>
                                        <td>' . $value['teacher_name'] . '</td>
                                        <td><span class="badge '. $badge.'">' . $status . '</span></td>
                                        <td>' . date_format(new DateTime($value['attendance_date']), 'd-F-Y') . '</td>
                                        <td>
                                            <a class="text-white btn btn-success btn-sm modal-load" href="edit.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a>      
                                        </td>
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
require_once '../../include/footer.php';
?>