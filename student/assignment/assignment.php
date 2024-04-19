<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: ../not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';

        require_once 'C:\xampp\htdocs\SAS\include\function.php';

        $q = "SELECT assignment.*,
            class.name as class_name, 
            book.name as book_name, 
            teacher.fullname as teacher_name
            FROM assignment 
            INNER JOIN class ON assignment.class_id = class.id 
            INNER JOIN book ON assignment.book_id = book.id 
            INNER JOIN teacher ON assignment.teacher_id = teacher.id 
            where book_id = " . $_GET['id'] . " ";
        $data = query($q);
        // print_r($data);

?>

        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center mt-4 font-weight-bold">Assignments</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Title</th>
                                    <th>Due Date</th>
                                    <th>Total Marks</th>
                                    <th>Submit</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($data as $value) {
                                    $q = "SELECT submission.* from submission where assignment_id = " . $value['id']
                                        . " AND student_id = " . $_SESSION['id'] . "";
                                    $check_value = query($q);
                        
                                    $badge = (@$check_value[0]['answer'] != null) ? 'Submitted'
                                        : (($value['due_date'] < date('Y-m-d')) ? 'Expired' : '<a href="'
                                            . $ROOT . '/student/assignment/assignment-submit.php?id=' . $value['id'] . '">view</a>');

                                    @$index += 1;
                                    echo  ' 
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['assignment_title'] . '</td>
                                        <td class="text-uppercase">'  . date_format(new DateTime($value['due_date']), 'd-F-Y') . '</td>
                                        <td>' . $value['total_marks'] . '</td>
                                        <td>' . $badge . '</td>
                                        <td></td>  
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
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