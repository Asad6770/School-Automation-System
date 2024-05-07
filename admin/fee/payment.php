<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $q = "SELECT voucher.*, class.name as class_name, fee.monthly_fee as monthly_fee, student.fullname as student_name,
    student.username as student_id FROM voucher INNER JOIN class ON voucher.class_id = class.id 
    INNER JOIN fee ON voucher.fee_id = fee.id JOIN student ON voucher.student_id = student.id where voucher.class_id = " . $class_id . " ";
    $data = query($q);
    // print_r($data);
    // exit();
} else {
    $q = "SELECT voucher.*, class.name as class_name, fee.monthly_fee as monthly_fee,  student.fullname as student_name, student.username as student_id
    FROM voucher INNER JOIN class ON voucher.class_id = class.id INNER JOIN fee ON voucher.fee_id = fee.id JOIN student ON voucher.student_id = student.id ";
    $data = query($q);
}
$class = select('class', '*');
?>

<div class="container-fluid">
    <div class="card mb-4">
        <form action="" method="POST">

            <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-center">
                <label class="font-weight-bold  mr-3" for="due_date">Class Name: </label>
                <select class="form-control col-3 text-uppercase" name="class_id" id="class_id">
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
                <a href="<?= $ROOT ?>/admin/fee/payment.php" type="button" class="btn btn-primary btn-sm ml-3">
                    <i class="fas fa-eye"></i>
                    View All Record
                </a>
            </div>

        </form>

    </div>
</div>



<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-center">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Paid/Unpaid Vouchers</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Class Name</th>
                            <th>Fee Amount</th>
                            <th>Due Date</th>
                            <th>Paid Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Class Name</th>
                            <th>Fee Amount</th>
                            <th>Due Date</th>
                            <th>Paid Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                        foreach ($data as $value) {

                            $badge = ($value['fee_status'] == 'paid') ? 'text-success' : 'text-danger';

                            $date = ($value['paid_date'] == '') ? '' . $value['fee_status'] . '' : '' . date_format(new DateTime($value['due_date']), 'd-F-Y') . '';

                            @$index += 1;
                            echo '
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['student_name'] . '</td>
                                        <td class="text-uppercase">' . $value['student_id'] . '</td>
                                        <td>Class ' . $value['class_name'] . '</td>
                                        <td>' . $value['monthly_fee'] . '</td>
                                        <td>' . date_format(new DateTime($value['due_date']), 'd-F-Y') . '</td>
                                        <td class="' . $badge . '">' . $date . '</td>    
                                        <td> <a class="text-white btn btn-success btn-sm modal-load" href="fee-status.php?id='
                                . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a> </td>
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
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>