<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$q = 'SELECT student.*, class.name AS class_name FROM student INNER JOIN class ON class.id = student.class_id';
$data = query($q);
?>

<div class="container-fluid">
    <div class="card input-group-sm mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Students (DMC)</h5>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Class Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data as $value) {
                            @$index += 1;
                            echo  ' 
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['fullname'] . '</td>
                                        <td>' . $value['username'] . '</td>
                                        <td>Class ' . $value['class_name'] . '</td>
                                        <td>
                                        <button class="text-white btn btn-info btn-sm print-btn" data-id="' . $value['id'] . '"><i class="fas fa-print"></i></button>|
                                            <a class="text-white btn btn-success btn-sm" href="edit-marks.php?student_id=' . $value['id'] . '">Edit</a> |
                                            <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="'
                                . $value['class_id'] . '">Delete</a>        
                                        </td>
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
<script>
    $('.print-btn').click(function() {
        var id = $(this).data('id');
        var url = 'http://localhost:90/SAS/admin/reports/dmc.php?student_id=' + id;
        var nw = window.open(url, '', 'height=700,width=950');
        nw.print();
        setTimeout(function() {
            nw.close();
        }, 750);
    });
</script>