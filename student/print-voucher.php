<?php
require_once '../include/function.php';
require_once '../include/student-config.php';
$q = "SELECT voucher.*,
        class.name as class_name, 
        fee.monthly_fee as monthly_fee, 
        student.fullname as student_name,
        student.username as student_id
        FROM voucher 
        INNER JOIN class ON voucher.class_id = class.id 
        INNER JOIN fee ON voucher.fee_id = fee.id  
        JOIN student ON voucher.student_id = student.id
        where student_id = " . $_SESSION['id'] . " AND voucher.id= " . $_GET['id'] . "
        ";
$data = query($q);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Voucher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 41%;
            height: 700px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin-right: 20px;
            text-align: left;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .student-info {
            margin-bottom: 20px;
        }

        .fee-details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }

        .copy {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Fee Voucher</h2>
        </div>
        <div class="student-info">
            <p><strong>Voucher No:</strong> <?= $data[0]['id'] ?></p>
            <p><strong>Student Name:</strong> <?= $data[0]['student_name'] ?></p>
            <p><strong>Student ID:</strong> <?= $data[0]['student_id'] ?></p>
            <p><strong>Class:</strong> <?= $data[0]['class_name'] ?></p>
        </div>
        <div class="fee-details">
            <table>
                <tr>
                    <th>Description</th>
                    <th>Amount (RS)</th>
                </tr>
                <tr>
                    <td>Tuition Fee</td>
                    <td><?= $data[0]['monthly_fee'] ?>.00</td>
                </tr>
                <tr>
                    <td>Sports Fee</td>
                    <td>50.00</td>
                </tr>
                <tr>
                    <td>Library Fee</td>
                    <td>100.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="total"><?= ($data[0]['monthly_fee'] + 100 + 50) ?>.00</td>
                </tr>
            </table>
        </div>
        <p><strong>Due Date:</strong> <?= date_format(new DateTime($data[0]['due_date']), 'd-F-Y') ?></p>
        <p><strong>Payment Instructions:</strong> Please submit the fee by the due date to avoid late fees.</p>
        <div class="copy">Student Copy</div>
    </div>

    <div class="container">
        <div class="header">
            <h2>Fee Voucher</h2>
        </div>
        <div class="student-info">
            <p><strong>Voucher No:</strong> <?= $data[0]['id'] ?></p>
            <p><strong>Student Name:</strong> <?= $data[0]['student_name'] ?></p>
            <p><strong>Student ID:</strong> <?= $data[0]['student_id'] ?></p>
            <p><strong>Class:</strong> <?= $data[0]['class_name'] ?></p>
        </div>
        <div class="fee-details">
            <table>
                <tr>
                    <th>Description</th>
                    <th>Amount (RS)</th>
                </tr>
                <tr>
                    <td>Tuition Fee</td>
                    <td><?= $data[0]['monthly_fee'] ?>.00</td>
                </tr>
                <tr>
                    <td>Sports Fee</td>
                    <td>50.00</td>
                </tr>
                <tr>
                    <td>Library Fee</td>
                    <td>100.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="total"><?= ($data[0]['monthly_fee'] + 100 + 50) ?>.00</td>
                </tr>
            </table>
        </div>
        <p><strong>Due Date:</strong> <?= date_format(new DateTime($data[0]['due_date']), 'd-F-Y') ?></p>
        <p><strong>Payment Instructions:</strong> Please submit the fee by the due date to avoid late fees.</p>
        <div class="copy">School Copy</div>
    </div>

</body>

</html>