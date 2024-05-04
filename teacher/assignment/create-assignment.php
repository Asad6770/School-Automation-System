<?php
require_once 'C:\xampp\htdocs\SAS\include\function.php';
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "tc") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';



        $class = select('class', '*');

?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center font-weight-bold mt-4">Add New Assignment</h5>
                </div>
                <hr class="sidebar-divider">
                <div class="card-body">
                    <form action="process.php" method="post" class="submitData">
                        <input type="hidden" class="form-control" name="type" value="create">

                        <div class="row justify-content-center">
                            <div class="col-3">
                                <label class="font-weight-bold mr-3" for="classId">Select Class</label>
                                <select class="form-control" name="classId" id="classId">
                                    <option value="">Select Class</option>
                                    <?php foreach ($class as $value) {
                                        echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <small class=" error classId_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </div>
                            <div class="col-3">
                                <label class="font-weight-bold mr-3" for="bookSelect">Select Book</label>
                                <select class="form-control" name="bookSelect" id="bookSelect">
                                    <option value="">Select Book</option>
                                </select>
                                <small class="error bookSelect_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </div>
                            <div class="col-2">
                                <label class="font-weight-bold" for="assignment_title">Assignment Title</label>
                                <input class="form-control" type="text" name="assignment_title" id="assignment_title">
                                <small class="error assignment_title_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </div>
                            <div class="col-2">
                                <label class="font-weight-bold" for="total_marks">Total Marks</label>
                                <input class="form-control" type="text" name="total_marks" id="total_marks">
                                <small class="error total_marks_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </div>
                            <div class="col-2">
                                <label class="font-weight-bold" for="due_date">Due Date</label>
                                <input class="form-control" type="date" name="due_date" id="due_date">
                                <small class="error due_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </div>

                            <div class="col-12 mt-4">
                                <label class="font-weight-bold" for="question">Assignment Question</label>
                                <textarea name="question" id="question"></textarea>
                                <small class="error question_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 col-2">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Noun</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S No</th>
                                    <th>Noun</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                // foreach ($data as $value) {
                                //     @$index += 1;
                                //     echo  '
                                //         <tr class="text-capitalize">
                                //             <td>' . $index . '</td>
                                //             <td>' . $value['name'] . '</td>
                                //             <td>' . date_format(new DateTime($value['date']), 'd-F-Y h:i:s') . '</td>
                                //             <td>
                                //                 <a class="text-white btn btn-success btn-sm modal-load" href="edit.php?id='
                                //         . $value['id'] . '"data-toggle="modal" data-target="#exampleModal">Edit</a> |
                                //         <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="' . $value['id'] . '">Delete</a>        
                                //             </td>
                                //         </tr>';
                                // }
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