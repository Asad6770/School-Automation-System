<?php
require_once '../include/student-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

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
?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
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
                        $index = 0;
                        foreach ($data as $value) {
                            $badge = ($value['fee_status'] == 'paid') ? 'text-success' : 'text-danger';
                            $date = ($value['paid_date'] == '') ? '<button class="print-btn" data-id="' . $value['id'] . '"><i class="fas fa-print"></i></button> <br>' . $value['fee_status'] . '' : '' . date_format(new DateTime($value['due_date']), 'd-F-Y') . '';
                            $index++;
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
</div>

<?php
require_once '../include/footer.php';
?>
<script>
    $('.print-btn').click(function() {
        var id = $(this).data('id');
        var url = 'http://localhost:90/SAS/student/print-voucher.php?id=' + id;
        var nw = window.open(url, '', 'height=700,width=950');
        nw.print();
        setTimeout(function() {
            nw.close();
        }, 750);
    });
</script>