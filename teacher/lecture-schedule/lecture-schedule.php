<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "tc") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {

        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';

        $teacher = select('teacher', '*');
        $class = select('class', '*');
?>

        <div class="container-fluid">

            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center mt-4 font-weight-bold">Lecture Schedule</h5>
                </div>
                <div class="card-body">
                    <form id="schedule-form" method="post" action="process.php">
                        <div class="table p-3">
                            <table class="table table-bordered" id="dynamic_field">
                                <tr>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Teacher</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="date" name="lecture_date[]" class="form-control" required/>
                                    </td>
                                    <td>
                                        <input type="time" name="start_time[]" class="form-control" required/>
                                    </td>
                                    <td>
                                        <input type="time" name="end_time[]" class="form-control" required/>
                                    </td>
                                    <td>
                                        <select class="form-control" name="teacher_id[]" id="teacher_id" required>
                                            <option value="">Select Class</option>
                                            <?php foreach ($teacher as $value) {

                                                echo '<option value="' . $value['id'] . '">' . $value['fullname'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                                </tr>

                            </table>

                            <div class="row justify-content-center m-4 inputRow">
                                <div class="input-group col-3">
                                    <select class="form-control" name="class_id" id="classId" required>
                                        <option value="">Select Class</option>
                                        <?php foreach ($class as $value) {
                                            echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group col-3">
                                    <select class="form-control" name="book_id" id="bookSelect" required>
                                        <option value="">Select Book</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-2">
                                Save Schedule
                            </button>
                        </div>
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

<script>
    $(document).ready(function() {

$('#add').click(function() {
    $('#dynamic_field').append(`
    <tr id="row">
        <td>
            <input type="date" name="lecture_date[]" class="form-control" required/>
        </td>
        <td>
            <input type="time" name="start_time[]" class="form-control" required/>
        </td>
        <td>
            <input type="time" name="end_time[]" class="form-control" required/>
        </td>
        <td>
            <select class="form-control" name="teacher_id[]" id="teacher_id" >
                <option value="">Select Class</option>
                <?php foreach ($teacher as $value) {

                    echo '<option value="' . $value['id'] . '">' . $value['fullname'] . '</option>';
                }
                ?>
            </select>
        </td>
        <td>
            <button type="button" name="remove" id="remove" class="btn btn-danger btn_remove">X</button>
        </td>
    </tr>`);
});

$(document).on('click', '.btn_remove', function() {
    $('#row').remove();
});


$('#schedule-form').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData.status == true) {
                Swal.fire(
                    'Deleted!',
                    jsonData.msg,
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
            else {
                alert('Something went wrong!');
            }

        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while inserting data');
        }
    });
});
});
</script>