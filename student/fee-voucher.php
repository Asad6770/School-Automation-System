<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';

        $q = "SELECT voucher.*,
        class.name as class_name, 
        fee.monthly_fee as monthly_fee, 
        student.fullname as student_name,
        student.username as student_id
        FROM voucher 
        INNER JOIN class ON voucher.class_id = class.id 
        INNER JOIN fee ON voucher.fee_id = fee.id  
        JOIN student ON voucher.student_id = student.id
        where student_id = " . $_SESSION['id'] . " 
        ";

        $data = query($q);
        // print_r($data);
        // exit();
?>

        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center mt-4 font-weight-bold">List of Fee Vouchers</h5>
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
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach ($data as $value) {
                                    $badge = ($value['fee_status'] == 'paid') ? 'text-success' : 'text-danger';
                                    $date = ($value['paid_date'] == '') ? '' . $value['fee_status'] . '' : '' . date_format(new DateTime($value['due_date']), 'd-F-Y') . '';
                                    @$index += 1;
                                    echo  '
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['student_name'] . '</td>
                                        <td class="text-uppercase">' . $value['student_id'] . '</td>
                                        <td>Class ' . $value['class_name'] . '</td>
                                        <td>' . $value['monthly_fee'] . '</td>
                                        <td>' . date_format(new DateTime($value['due_date']), 'd-F-Y') . '</td>
                                        <td class="' . $badge . '">' . $date . '</td>                                         
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    <?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
    ?>