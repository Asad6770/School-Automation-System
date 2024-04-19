<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: ../not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';
        $q = 'SELECT book.*, class.name AS class_name
        FROM book
        INNER JOIN class ON class.id = book.class_id
        where book.class_id = ' . $_SESSION['class_id'] . '
        ';
        $data = query($q);
        // print_r($data);

?>

        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center mt-4 font-weight-bold">Coruse Selection</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Book Name</th>
                                    <th>Class Name</th>
                                    <th>Selection Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <form action="process.php" method="post" class="submitData">
                                    <input type="text" name="type" value="create" hidden>
                                    <?php
                                    foreach ($data as $value) {
                                        @$index += 1;
                                        echo  ' 
                                        <input type="text" name="class_id" value='. $value['class_id'] .' hidden>
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td>Class ' . $value['class_name'] . '</td>
                                        <td>' . $value['selection_type'] . '</td>           
                                        <td>
                                            <input style="width: 1.25rem; height: 1.25rem;"  type="checkbox" value="' 
                                            . $value['id'] . '" name="selected_course_id[]">
                                        </td>  
                                    </tr>';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Save Attendance
                        </button>
                    </div>
                </div>
                </form>
            </div>
            
    


    <?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
    ?>