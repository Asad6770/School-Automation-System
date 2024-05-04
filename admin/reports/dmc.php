<?php
session_start();
if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 5) != "admin") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';


        $q = 'SELECT dmc.*, book.name AS book_name, student.fullname as student_name,
        class.name as class_name, student.username as std_id  FROM dmc INNER JOIN book ON book.id = dmc.book_id 
        INNER JOIN student ON student.id = dmc.student_id
        INNER JOIN class ON class.id = dmc.class_id
        WHERE student_id=  ' . $_GET['student_id'];
        $dmc = query($q);
?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body mt-4">
                    <?php if (@$dmc[0] > 0) { ?>
                        <div class="container border border-secondary rounded p-5 text-dark" id="printable">
                            <div class="row">
                                <div class="col">
                                    <h2 class="text-center mb-4 font-weight-bold">Detailed Marks Certificate</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Student Name: </strong><?= $dmc[0]['student_name'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Father Name:</strong> Muhammad Ali</p>
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
                        <div class="row mt-5">
                            
                            <div class="col text-center">
                            <a href="<?= $ROOT ?>/teacher/questions/question.php" class="btn btn-primary">
                                Back
                            </a>
                                <button id="print" class="btn btn-success">Print</button>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo '
                            <div class="card-header d-flex flex-row align-items-center justify-content-center">
                                <h5 class="card-title text-center mt-4 font-weight-bold">Detailed Marks Certificate</h5>
                            </div>
                            <div class="text-center font-weight-bold mb-1">No data available</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <noscript>
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

                /* Container */
                .container {
                    max-width: 1140px;
                    margin: 0 auto;
                }

                /* Borders and Rounded Corners */
                .border {
                    border: 1px solid rgba(0, 0, 0, 0.2);
                }

                .rounded {
                    border-radius: 0.25rem;
                }

                /* Padding */
                .p-5 {
                    padding: 3rem !important;
                }

                /* Text Color */
                .text-dark {
                    color: #343a40 !important;
                }

                /* Margins */
                .mb-4 {
                    margin-bottom: 1.5rem !important;
                }

                .mt-5 {
                    margin-top: 3rem !important;
                }

                /* Text Alignment */
                .text-center {
                    text-align: center !important;
                }

                .text-left {
                    text-align: left !important;
                }

                /* Font Weight */
                .font-weight-bold {
                    font-weight: bold !important;
                }

                /* Table */
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

                /* Background Color */
                .bg-light {
                    background-color: #f8f9fa !important;
                }

                /* Text Color */
                .text-uppercase {
                    text-transform: uppercase !important;
                }

                /* Text Color */
                .text-primary {
                    color: #007bff !important;
                }

                h2 {
                    text-align: center;
                }
            </style>
        </noscript>

<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>

<script>
    function start_load() {
        $('#loading-spinner').show();
    }

    function end_load() {
        $('#loading-spinner').hide();
    }

    $('#print').click(function() {
        start_load()
        var ns = $('noscript').clone()
        var content = $('#printable').clone()
        ns.append(content)
        var nw = window.open('', '', 'height=700,width=950')
        nw.document.write(ns.html())
        nw.document.close()
        nw.print()
        setTimeout(function() {
            nw.close()
            end_load()
        }, 750)

    })
</script>