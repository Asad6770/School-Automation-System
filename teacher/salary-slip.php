<?php
require_once '../include/teacher-config.php';
require_once '../include/function.php';
require_once '../include/header.php';

if (isset($_POST['salary_month'])) {
    $salary_month = $_POST['salary_month'];
    $q = "SELECT salary.*, teacher.* FROM salary INNER JOIN teacher ON salary.teacher_id = teacher.id 
    where teacher_id = " . $_SESSION['id'] . " AND salary_month = '$salary_month' 
    AND salary_year = " . date('Y') . "";
    // echo $q;
    $data = query($q);
} else {
    $current_month = date('n');
    $q = "SELECT salary.*, teacher.* FROM salary JOIN teacher ON salary.teacher_id = teacher.id 
    where teacher_id = " . $_SESSION['id'] . " AND salary_month = '$current_month' 
    AND salary_year = " . date('Y') . "";
    // echo $q;
    $data = query($q);
}
?>
<div class="container-fluid">
    <div class="card mb-4">
        <form action="" method="POST">
            <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-center">
                <label class="font-weight-bold mr-3" for="salary_month">Salary Month</label>
                <select class="form-control col-3" name="salary_month" id="salary_month" required>
                    <option>Select Month</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $month = date('F', mktime(0, 0, 0, $i, 1));
                        echo "<option value='" . $i . "'>" . $month . "</option>";
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
        <div class="container mt-5 mb-5">
            <div class="row">
                <?php if (@$data[0] != null) { ?>

                    <div class="col-md-12">
                        <div class="text-center mb-2">
                            <h6 class="font-weight-bold">Salary Slip</h6> <span class="fw-normal">
                                Salary slip for the month of <?= date('F', mktime(0, 0, 0, $data[0]['salary_month'], 1)) ?> <?= $data[0]['salary_year'] ?></span>
                        </div>
                        <div class="d-flex justify-content-end"> <span><small class="ms-3">Computer Generated Salary Slip</small></span> </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div> <span class="font-weight-bold">Teacher ID</span> <small class="ms-3"><?= ucwords($data[0]['username']) ?></small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div> <span class="font-weight-bold">Teacher Name</span> <small class="ms-3"><?= ucwords($data[0]['fullname']) ?></small> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div> <span class="font-weight-bold">Phone No.</span> <small class="ms-3"><?= ucwords($data[0]['phone_no']) ?></small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div> <span class="font-weight-bold">Mode of Pay</span> <small class="ms-3">Cash</small> </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div> <span class="font-weight-bold">Designation</span> <small class="ms-3">Teacher (TC)</small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div> <span class="font-weight-bold">Address.</span> <small class="ms-3"><?= ucwords($data[0]['address']) ?></small> </div>
                                    </div>
                                </div>
                            </div>
                            <table class="mt-4 table text-center table-bordered">
                                <thead class="bg-primary  text-white">
                                    <tr>
                                        <th scope="col">Basic Salary</th>
                                        <th scope="col">Allowances</th>
                                        <th scope="col">Deductions</th>
                                        <th scope="col">Net Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Rs <?= $data[0]['basic_salary'] ?></th>
                                        <td>Rs <?= $data[0]['allowances'] ?></td>
                                        <td>-</td>
                                        <td>Rs<?= $data[0]['basic_salary'] + $data[0]['allowances'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } else {
                    echo '<div class="text-center font-weight-bold col-12">No Salary Slip Found</div>';
                }
                    ?>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../include/footer.php';
?>