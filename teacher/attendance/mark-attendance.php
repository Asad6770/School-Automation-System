<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $q = 'SELECT student.*, class.name 
    as class_name 
    FROM student 
    INNER JOIN class 
    ON student.class_id = class.id
    where class_id = "' . $class_id . '"';
    $data = query($q);

} else {
    $class_id = '';

    $data = 0;
}

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "tc") {
        header("Location: " . $ROOT . "/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';

        $class = select('class', '*');
        if(isset($data[0]['class_id'])){
        $book = select('book', '*', "class_id =". $data[0]['class_id']);
        }
?>
        <div class="container-fluid">
            <?php
            if (isset($_SESSION['message'])) {
                $message_class = strpos($_SESSION['message'], 'Error') !== false ? 'alert-danger' : 'alert-success';
                echo "<div class='alert $message_class'>{$_SESSION['message']}</div>";
                unset($_SESSION['message']); // Clear the message after displaying it
            }
            ?>
            <div class="card mb-4">
                <form action="" method="POST">
                    <div class="card-header input-group-sm d-flex flex-row align-items-center justify-content-center">
                        <label class="font-weight-bold  mr-3" for="attendance_date">Class: </label>
                        <select class="form-control col-3 text-uppercase" name="class_id" id="class_id">
                            <option value="">Select Class</option>
                            <?php
                            foreach ($class as $value) {
                                echo ' <option value=' . $value['id'];
                                if ($value['id'] == @$class_id) {
                                    echo 'selected = selected';
                                }
                                echo '>' . $value['name'] . '</option>';
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
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center font-weight-bold">Attendance Mark Form</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <form action="process.php" method="post" class="submitData">
                                    <tr>
                                        <th>S No</th>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Status</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (@$data > 0) {
                                    foreach ($data as $value) {
                                        @$index += 1;
                                        echo  ' 
                                            <tr class="text-capitalize">
                                                <td> ' . $index . '</td>
                                                <td>
                                                <input type="text" value=' . $value['id'] . ' name="student_id[]" hidden>'
                                            . $value['fullname'] . '
                                                </td>
                                                <td class="text-uppercase">' . $value['username'] . '</td>
                                                <td class="justify-content-center"> 
                                                    <select class="border-0 bg-transparent" name="attendance_status[]" id="status">
                                                        <option>Select Class</option>
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <input type="text" value=' . $class_id . ' name="class_id" hidden>
                                            ';
                                    }
                                } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-row input-group-sm align-items-center justify-content-center">
                        <?php if ($data != null) { ?>

                            <label class="font-weight-bold  mr-3" for="attendance_date">Attendance Date: </label>
                            <input class="form-control col-2 mr-3" type="date" name="attendance_date" id="attendance_date">

                            <label class="font-weight-bold  mr-3" for="book_id">Subject: </label>
                            <select class="form-control col-2 mr-3  text-uppercase" name="book_id" id="book_id">

                                <option value="">Select Book</option>
                                <?php
                                foreach ($book as $value) {
                                    echo ' <option value=' . $value['id'];

                                    echo '>' . $value['name'] . '</option>';
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Save Attendance
                            </button>
                    </div>
                <?php   }
                 else {
                    echo '<div class="text-center font-weight-bold col-12">No data available in table</div>';
                }  ?>
                </form>
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