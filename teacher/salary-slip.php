<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if (isset($_POST['salary_month'])) {
    $salary_month = $_POST['salary_month'];
    $q = "SELECT salary.*, teacher.* FROM salary INNER JOIN teacher ON salary.teacher_id = teacher.id 
    where teacher_id = " . $_SESSION['id'] . " AND salary_month = '$salary_month' 
    AND salary_year = " . date('Y') . "";
    // echo $q;
    $data = query($q);
} else {
    $date = date_create_from_format('m', date('m'));
    $month = date_format($date, 'F');
    $current_month = strtolower($month);

    $q = "SELECT salary.*, teacher.* FROM salary JOIN teacher ON salary.teacher_id = teacher.id 
    where teacher_id = " . $_SESSION['id'] . " AND salary_month = '$current_month' 
    AND salary_year = " . date('Y') . "";
    // echo $q;
    $data = query($q);
}

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "tc") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';

        $class = select('class', '*');
?>
        <div class="container-fluid">
            <?php
            if (isset($_SESSION['message'])) {
                $message_class = strpos($_SESSION['message'], 'Error') !== false ? 'alert-danger' : 'alert-success';
                echo "<div class='alert $message_class'>{$_SESSION['message']}</div>";
                unset($_SESSION['message']); // Clear the message after displaying it
            }
            ?>
            <div class="card mb-4">
                <form action="" method="POST">
                    <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-center">
                        <label class="font-weight-bold mr-3" for="salary_month">Salary Month</label>
                        <select class="form-control col-3" name="salary_month" id="salary_month" required>
                            <option>Select Month</option>
                            <option value="january">January</option>
                            <option value="february">February</option>
                            <option value="march">March</option>
                            <option value="april">April</option>
                            <option value="may">May</option>
                            <option value="june">June</option>
                            <option value="july">July</option>
                            <option value="august">August</option>
                            <option value="september">September</option>
                            <option value="cctober">October</option>
                            <option value="november">November</option>
                            <option value="december">December</option>
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
                                        Salary slip for the month of <?= ucwords($data[0]['salary_month']) ?> <?= $data[0]['salary_year'] ?></span>
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
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>