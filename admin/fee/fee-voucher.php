<?php
require_once 'C:\xampp\htdocs\SAS\include\admin-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

if (isset($_POST['class_id']) == '') {
    $class_id = 0;
    $data = 0;
} elseif (isset($_POST['class_id'])) {

    $class_id = $_POST['class_id'];
    $q = 'SELECT fee.*, class.name AS class_name, class.id AS cls_id, student.fullname as student_name, student.username as student_id,
    student.id as std_id FROM fee INNER JOIN class ON fee.class_id = class.id INNER JOIN student ON student.class_id = class.id 
    WHERE class.id =  "' . $class_id . '"';
    $data = query($q);
    // print_r($data);
    // exit();
}
$class = select('class', '*');
?>

<div class="container-fluid">
    <div class="card mb-4">
        <form action="" method="POST">

            <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-center">
                <label class="font-weight-bold  mr-3" for="due_date">Class Name: </label>
                <select class="form-control col-3 text-uppercase" name="class_id" id="class_id">
                    <option value="">Select Class</option>
                    <?php
                    foreach ($class as $value) {
                        echo ' <option value=' . $value['id'];
                        if ($value['id'] == @$class_id) {
                            echo 'selected = selected';
                        }
                        echo '>Class ' . $value['name'] . '</option>';
                    }
                    ?>
                </select>
                <button href="process.php" type="submit" class="btn btn-primary btn-sm ml-3">
                    <i class="fas fa-search"></i>
                    Search
                </button>
            </div>
        </form>
    </div>
</div>



<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List Of Fee Voucher</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Name</th>
                            <th>Student ID</th>
                            <th>Monthly Fee</th>
                            <th>Class Name</th>
                        </tr>
                    </thead>

                    <tbody>
                        <form action="process.php" method="post" class="submitData">
                            <?php
                            if (@$data[0] > 0) {
                                foreach ($data as $value) {
                                    @$index += 1;
                                    echo  '
                                            <input type="text" name="student_id[]" value="' . $value['std_id'] . '" hidden/>
                                            <input type="text" name="fee_id" value="' . $value['id'] . '" hidden/>
                                            <input type="text" name="class_id" value="' . $value['cls_id'] . '" hidden/>
                                            <tr class="text-capitalize">
                                                <th>' . $index . '</th>
                                                <td>' . $value['student_name'] . '</td>
                                                <td>' . $value['student_id'] . '</td>
                                                <td>
                                                <input class="form-control border-0 bg-transparent text-center" type="text" name="monthly_fee" value="'
                                        . $value['monthly_fee'] . '" readonly/>
                                                </td>
                                                <td> Class ' . $value['class_name'] . '</td>
                                            </tr>';
                                }
                            } else {
                                echo  '
                                        <tr class="text-capitalize">
                                            <td colspan = "7">no data found</td>  
                                        </tr>';
                            }
                            ?>

                    </tbody>
                </table>
                <hr class="sidebar-divider">
                <?php if (@$data !== 0) { ?>
                    <div class="d-flex flex-row input-group-sm align-items-center justify-content-center">

                        <label class="font-weight-bold  mr-3" for="due_date">Due Date: </label>
                        <input class="form-control col-2 mr-3" type="date" name="due_date" id="due_date">

                        <button type="submit" class="btn btn-primary btn-sm">
                            Save Voucher
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>