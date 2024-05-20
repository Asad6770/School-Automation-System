<?php
require_once '../include/teacher-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$student = select('student', '*');
$teacher = select('teacher', '*');

$q = 'SELECT * FROM salary WHERE teacher_id = '.$_SESSION['id'].' AND salary_month="' . date('n') . '"';
$data = query($q);
if (@$data[0] > 0) {
   $total_salary = ($data[0]['basic_salary'] + $data[0]['allowances']);
}else{
    $total_salary = '';
}


?>

<div class="container-fluid" id="container-wrapper">
    <div class="row mb-3">
    <div class="col-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar fa-2x text-primary"></i>
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Salary (Current Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-success">RS <?= $total_salary ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        
    </div>
</div>

<?php
require_once '../include/footer.php';
?>