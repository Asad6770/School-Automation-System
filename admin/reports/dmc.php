<?php
require_once '../../include/admin-config.php';
require_once '../../include/function.php';


$q = 'SELECT reports.*, book.name AS book_name, student.fullname as student_name, class.name as class_name, student.username as std_id, 
student.father_name as father_name FROM reports INNER JOIN book ON book.id = reports.book_id INNER JOIN student ON student.id = reports.student_id 
INNER JOIN class ON class.id = reports.class_id WHERE student_id=  ' . $_GET['student_id'];
$dmc = query($q);
?>
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .container {
        max-width: 1140px;
        margin: 0 auto;
    }

    .border {
        border: 1px solid rgba(0, 0, 0, 0.2);
    }

    .rounded {
        border-radius: 0.25rem;
    }

    .p-5 {
        padding: 3rem !important;
    }

    .text-dark {
        color: #343a40 !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .mt-5 {
        margin-top: 3rem !important;
    }

    .text-center {
        text-align: center !important;
    }

    .text-left {
        text-align: left !important;
    }

    .font-weight-bold {
        font-weight: bold !important;
    }

    .table {
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    .table th {
        background-color: #f0f0f0;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .text-uppercase {
        text-transform: uppercase !important;
    }

    .text-primary {
        color: #007bff !important;
    }

    .col {
        flex: 0 0 100%;
        max-width: 100%;
    }
</style>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <?php if (@$dmc[0] > 0) { ?>
                <div class="container border border-secondary rounded mt-5 p-5 text-dark" id="printable">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-center mb-5 font-weight-bold">Detailed Marks Certificate</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Student Name: </strong><?= $dmc[0]['student_name'] ?></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Father Name:</strong> <?= $dmc[0]['father_name'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Student ID: </strong><span class="text-uppercase"><?= $dmc[0]['std_id'] ?></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Class:</strong> <?= $dmc[0]['class_name'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>School Name:</strong> School Automation System.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Total Marks</th>
                                        <th>Obtained Marks</th>
                                        <th>Percentage</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dmc as $value) {
                                        @$total += $value['total_marks'];
                                        @$obtained += $value['obtained_marks'];
                                    ?>
                                        <tr class="text-center">
                                            <td class="font-weight-bold text-left"><?= $value['book_name'] ?></td>
                                            <td><?= $value['total_marks'] ?></td>
                                            <td><?= $value['obtained_marks'] ?></td>
                                            <td><?= $value['obtained_marks'] / $value['total_marks'] * 100 ?>%</td>
                                            <td class="text-primary">
                                                <?php
                                                if ($value['obtained_marks'] >= 90) {
                                                    echo 'A';
                                                } elseif ($value['obtained_marks'] >= 80) {
                                                    echo 'B';
                                                } elseif ($value['obtained_marks'] >= 70) {
                                                    echo 'C';
                                                } elseif ($value['obtained_marks'] >= 60) {
                                                    echo 'D';
                                                } else {
                                                    echo 'F';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <p><strong>Total Marks Obtained:</strong> <?= $obtained ?></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Total Marks:</strong> <?= $total ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Overall Percentage:</strong> <?= number_format($obtained / $total * 100, 1) ?>%</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Grade:</strong>
                                <?php
                                $grade = number_format($obtained / $total * 100, 1);
                                if ($grade >= 90) {
                                    echo 'A';
                                } elseif ($grade >= 80) {
                                    echo 'B';
                                } elseif ($grade >= 70) {
                                    echo 'C';
                                } elseif ($grade >= 60) {
                                    echo 'D';
                                } else {
                                    echo 'F';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <p><strong>Date of Issue:</strong> <?= date_format(new DateTime(), 'd F, Y') ?>
                        </div>
                        <div class="col-6">
                            <p><strong>Principal's Signature:</strong> __________________</p>
                        </div>
                    </div>

                </div>
            <?php
            } else {
                echo '<div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h5 class="card-title text-center font-weight-bold">Detailed Marks Certificate</h5>
                    </div>
                    <div class="text-center font-weight-bold mt-3">No data available</div>';
            }
            ?>
        </div>
    </div>
</div>