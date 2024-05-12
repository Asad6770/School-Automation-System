<?php
require_once 'C:\xampp\htdocs\SAS\include\teacher-config.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';

$class = select('class', '*');
$q = 'SELECT assignment.*, book.name AS book_name, class.name AS class_name FROM Assignment INNER JOIN book 
ON book.id = assignment.book_id INNER JOIN class ON class.id = assignment.class_id WHERE teacher_id=' . $_SESSION['id'] . '';
$assignmnts = query($q);
// print_r($assignmnts);
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center font-weight-bold mt-4">Create Assignment</h5>
        </div>
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
                        <label class="font-weight-bold" for="total_score">Total Score</label>
                        <input class="form-control" type="text" name="total_score" id="total_score">
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
                            <th>Title</th>
                            <th>Question</th>
                            <th>Total Marks</th>
                            <th>Class Name</th>
                            <th>Book Name</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Title</th>
                            <th>Question</th>
                            <th>Total Marks</th>
                            <th>Class Name</th>
                            <th>Book Name</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($assignmnts as $value) {
                            @$index += 1;
                            echo  '
                                <tr class="text-capitalize align-middle">
                                    <td>' . $index . '</td>
                                    <td>' . $value['assignment_title'] . '</td>
                                    <td>' . $value['question'] . '</td>
                                    <td>' . $value['total_score'] . '</td>
                                    <td>Class ' . $value['class_name'] . '</td>
                                    <td>' . $value['book_name'] . '</td>
                                    <td>' . date_format(new DateTime($value['due_date']), 'd-F-Y') . '</td>
                                    <td>
                                    <a class="text-white btn btn-success btn-sm" href="edit-assignment.php?id='
                                    . $value['id'] . '">Edit</a> |
                                                <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="'
                                    . $value['id'] . '">Delete</a> 
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
    ClassicEditor
        .create(document.querySelector('#question'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
     $(document).ready(function() {
        $('#classId').change(function() {
            var classId = $(this).val();
            $.ajax({
                type: 'GET',
                url: 'process.php',
                data: {
                    class_id: classId
                },
                success: function(response) {
                    $('#bookSelect').html(response);
                }
            });
        });
    });
</script>
