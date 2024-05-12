<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$q = 'SELECT book.*, class.name AS class_name FROM book INNER JOIN class ON class.id = book.class_id 
where book.class_id = ' . $_SESSION['class_id'] . '';

$data = query($q);
$selection = select('course_selection', '*', 'student_id=' . $_SESSION['id']);
$course_selection = select('admin', 'course_selection');
// print_r($course_selection);
?>
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Coruse Selection</h5>
        </div>
        <div class="card-body">
            <?php
            if (@$course_selection[0]['course_selection'] == 'enable') {
                if (@$selection[0]['student_id'] == 0) { ?>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Book Name</th>
                                    <th>Class Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <form action="process.php" method="post" class="submitData">
                                    <input type="text" name="type" value="create" hidden>
                                    <?php
                                    foreach ($data as $key => $value) {
                                        @$index += 1;
                                        echo  ' 
                                            <input type="text" name="class_id" value=' . $value['class_id'] . ' hidden>
                                            <tr class="text-capitalize">
                                                <td>' . $index . '</td>
                                                <td>' . $value['name'] . '</td>
                                                <td>Class ' . $value['class_name'] . '</td>          
                                                <td>
                                                    <input type="checkbox" id="checkbox' . $key . '" class="switch-checkbox" 
                                                    value="' . $value['id'] . '" name="selected_book_id[]" style="display: none;">
                                                    <label for="checkbox' . $key . '" class="switch"></label>
                                                </td>  
                                            </tr>';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
        </div>
        </form>
    <?php } else { ?>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th>S No</th>
                        <th>Book Name</th>
                        <th>Class Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <form action="process.php" method="post" class="submitData">
                        <input type="text" name="type" value="edit" hidden>
                        <?php
                        foreach ($data as $key => $value) {
                            $checked = ($value['id'] == @$selection[$key]['book_id']) ? 'checked' : '';
                            @$index += 1;
                            echo  '<input type="text" name="class_id" value=' . $value['class_id'] . ' hidden>
                                <tr class="text-capitalize">
                                    <td>' . $index . '</td>
                                    <td>' . $value['name'] . '</td>
                                    <td>Class ' . $value['class_name'] . '</td>          
                                    <td>
                                        <input type="checkbox" id="checkbox' . $key . '" class="switch-checkbox" 
                                        value="' . $value['id'] . '" name="selected_book_id[]" ' . $checked . ' style="display: none;">
                                        <label for="checkbox' . $key . '" class="switch"></label>
                                    </td>  
                                </tr>';
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </div>
    </form>
<?php
                }
            } else {
                echo '<div class="text-center text-danger font-weight-bold mb-1">Course Selection is Disabled!</div>';
            }
?>
</div>
</div>
<?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>