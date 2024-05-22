<?php
require_once '../../include/admin-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$teacher = select('teacher', '*');
$class = select('class', '*');

$q = 'SELECT lecture_schedule.*, class.name as class_name, book.name as book_name, teacher.fullname as teacher_name, 
lectures.lecture_no AS lec_no FROM lecture_schedule INNER JOIN class ON class.id = lecture_schedule.class_id 
INNER JOIN book ON book.id = lecture_schedule.book_id INNER JOIN lectures ON lectures.id = lecture_schedule.lecture_id 
INNER JOIN teacher ON teacher.id = lecture_schedule.teacher_id ORDER BY lecture_schedule.id DESC';

$lecture = query($q);
// print_r($lecture);
?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">Create Lectures Schedule</h5>
        </div>
        <div class="card-body">
            <form id="schedule-form" method="post" class="submitData" action="process.php">
                <input type="hidden" class="form-control" name="type" value="create-schedule">
                <div class="table p-3">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Lecture No</th>
                            <th>Teacher</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" name="lecture_date[]" class="form-control" required />
                                <small class="error lecture_date_error text-danger font-weight-bold" style="font-size: 15px;"></small>
                            </td>
                            <td>
                                <select name="start_time[]" class="form-control">
                                    <option value="">Start Time</option>
                                    <?php
                                    $times = array('07:45', '08:30', '09:15', '10:00', '10:45', '11:30', '12:00', '12:45', '13:30');
                                    foreach ($times as $time) {
                                        if ($time == '12:00') {
                                            echo '<option value="break" disabled>Break (12:00 - 12:30)</option>';
                                        } else {
                                            echo '<option value="' . $time . '">' . $time . '</option>';
                                        }
                                    }
                                    echo '</select>';
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="end_time[]" class="form-control">
                                    <option value="">End Time</option>
                                    <?php
                                    $times = array('08:30', '09:15', '10:00', '10:45', '11:30', '12:00', '12:45', '13:30');
                                    foreach ($times as $time) {
                                        if ($time == '12:00') {
                                            echo '<option value="break" disabled>Break (12:00 - 12:30)</option>';
                                        } else {
                                            echo '<option value="' . $time . '">' . $time . '</option>';
                                        }
                                    }
                                    echo '</select>';
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control lecture_selected" name="lecture_id[]" id="lecture_id" required>
                                    <option value="">Lecture</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="teacher_id[]" id="teacher_id" required>
                                    <option value="">Teacher</option>
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
                        <div class="input-group col-3">
                            <button type="submit" class="btn btn-primary">
                                Save Schedule
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <hr class="sidebar-divider">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>S No</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Class</th>
                            <th>Book</th>
                            <th>Lecture No</th>
                            <th>Teacher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S No</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Class</th>
                            <th>Book</th>
                            <th>Lecture No</th>
                            <th>Teacher</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($lecture as $key => $value) {
                            echo  ' <tr class="text-capitalize">
                                        <th>' . $key + 1 . '</th>
                                        <td>' . date_format(new DateTime($value['lecture_date']), 'd-F-Y') . '</td>
                                        <td>'  . date('H:i', strtotime($value['start_time'])) . '</td>
                                        <td>' . date('H:i', strtotime($value['end_time'])) . '</td>
                                        <td>Class ' . $value['class_name'] . '</td> 
                                        <td>' . $value['book_name'] . '</td> 
                                        <td>Lecture No ' . $value['lec_no'] . '</td> 
                                        <td>' . $value['teacher_name'] . '</td> 
                                        <td>
                                            <a class="text-white btn btn-success btn-sm" href="edit-schedule.php?id='
                                . $value['id'] . '">Edit</a> |
                                            <a class="text-white btn btn-danger  btn-sm delete" href="process.php" data-id="'
                                . $value['id'] . '">Delete</a>        
                                        </td> 
                                    </tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../../include/footer.php';
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
        <select name="start_time[]" class="form-control" required>
        <option value="">Start Time</option>
        <?php
        $times = array('07:45', '08:30', '09:15', '10:00', '10:45', '11:30', '12:00', '12:45', '13:30');
        foreach ($times as $time) {
            if ($time == '12:00') {
                echo '<option value="break" disabled>Break (12:00 - 12:30)</option>';
            } else {
                echo '<option value="' . $time . '">' . $time . '</option>';
            }
        }
        echo '</select>';
        ?>
            </select>
        </td>
        <td>
        <select name="end_time[]" class="form-control" required>
            <option value="">End Time</option>
            <?php
            $times = array('08:30', '09:15', '10:00', '10:45', '11:30', '12:00', '12:45', '13:30');
            foreach ($times as $time) {
                if ($time == '12:00') {
                    echo '<option value="break" disabled>Break (12:00 - 12:30)</option>';
                } else {
                    echo '<option value="' . $time . '">' . $time . '</option>';
                }
            }
            echo '</select>';
            ?>
        </select>
        </td>
        <td>
            <select class="form-control lecture_selected" name="lecture_id[]" id="lecture_id" required>
                <option value="">Lecture</option>
            </select>
        </td>
        <td>
            <select class="form-control" name="teacher_id[]" id="teacher_id" >
                <option value="">Teacher</option>
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


        $('#classId').change(function() {
            var classId = $(this).val();
            console.log(classId);
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

        $('#bookSelect').change(function() {
            var bookId = $(this).val();
            console.log(bookId);
            $.ajax({
                type: 'GET',
                url: 'process.php',
                data: {
                    book_id: bookId
                },
                success: function(response) {
                    $('.lecture_selected').html(response);
                }
            });
        });

    });
</script>