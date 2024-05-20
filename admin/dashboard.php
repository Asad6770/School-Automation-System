<?php
require_once '../include/admin-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$fee_status = 'unpaid';
$student = select('student', '*');
$teacher = select('teacher', '*');
$voucher = select('voucher', '*',  "fee_status = 'unpaid'");
$q = 'SELECT attendance_status FROM teacher_attendance WHERE attendance_status = 1 AND attendance_date="' . date('Y-m-d') . '"';
$available_teacher = query($q);
// print_r($available_teacher);
?>

<div class="container-fluid" id="container-wrapper">
    <div class="row mb-3">
        <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total No of Student</div>
                            <div class="h5 mb-0 font-weight-bold text-success"><?= Count($student) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="font-weight-bold text-uppercase mb-1">Total No of Teacher</div>
                            <div class="h5 mb-0 font-weight-bold text-success"><?= Count($teacher) ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">No of Student (Unpaid fee)</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-success"><?= Count($voucher) ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">No of Teacher (Today)</div>
                            <div class="h5 mb-0 font-weight-bold text-success"><?= Count($available_teacher) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require_once '../include/footer.php';
?>