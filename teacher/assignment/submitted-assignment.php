<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "tc") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';

        $q = 'SELECT
        submission.*,
        assignment.assignment_title AS title,
        student.fullname AS student_name,
        student.username AS student_username,
        book.name AS book_name,
        class.name AS class_name
        FROM
        submission
        INNER JOIN assignment ON assignment.id = submission.assignment_id
        INNER JOIN student ON student.id = submission.student_id
        INNER JOIN book ON book.id = assignment.book_id
        INNER JOIN class ON class.id = assignment.class_id
        where teacher_id = ' . $_SESSION['id'] . ' ';
        // echo $q;
        $data = query($q);
        // print_r($data);

?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center font-weight-bold mt-4">Add New Assignment</h5>
                </div>
                <hr class="sidebar-divider">
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Class Name</th>
                                    <th>Book</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Class Name</th>
                                    <th>Book</th>
                                    <th>Title</th>
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
                                            <td>' . $value['student_name'] . '</td>
                                            <td>' . $value['student_username'] . '</td>
                                            <td>' . $value['class_name'] . '</td>
                                            <td>' . $value['book_name'] . '</td>
                                            <td>' . $value['title'] . '</td>
                                            <td>
                                                <a class="text-white btn btn-success btn-sm modal-load" href="view-assignment.php?id='
                                        . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Check Assignment</a> 
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
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>
<script>
    ClassicEditor
        .create(document.querySelector('#question'))
        .catch(error => {
            console.error(error);
        });
</script>