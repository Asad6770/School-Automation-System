<?php
require_once 'C:\xampp\htdocs\SAS\include\student-config.php';
require_once 'C:\xampp\htdocs\SAS\include\header.php';
require_once 'C:\xampp\htdocs\SAS\include\function.php';

$sql = 'SELECT lecture_schedule.*, book.name AS book_name, teacher.fullname AS teacher_name
        FROM lecture_schedule INNER JOIN book ON book.id = lecture_schedule.book_id
        INNER JOIN teacher ON teacher.id = lecture_schedule.teacher_id
        where lecture_schedule.class_id = ' . $_SESSION['class_id'] . ' ORDER BY lecture_date, start_time';
$data = query($sql);
?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of Lecture Schedule</h5>
        </div>
        <div class="card-body">
            <?php
            if (@$data > 0) {

                echo '
                            <div class="container" id="printable">
                                <table class="table table-bordered text-center">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Time</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                $lecture_schedule = [];

                foreach ($data as $value) {
                    $day = date('l', strtotime($value['lecture_date']));
                    $start_time = date('H:i', strtotime($value['start_time']));
                    $end_time = date('H:i', strtotime($value['end_time']));
                    $book = $value['book_name'];
                    $teacher = $value['teacher_name'];

                    $lecture_schedule[$day][$start_time] = "<span>$book</span>  <br> <span>$teacher</span>  <br> <span>$start_time - $end_time</span> ";
                }
                $times = array('08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00');
                foreach ($times as $time) {
                    echo '
                                <tr>
                                    <th class="align-middle bg-primary text-white">' . $time . '</th>';
                    foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) {
                        echo '<td class="align-middle" style="height: 100px; width: 200px;">';
                        echo isset($lecture_schedule[$day][$time]) ? $lecture_schedule[$day][$time] : '';
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody>
                        </table>
                    </div>';
            } else {
                echo '<div class="text-center font-weight-bold mb-1">No data available</div>';
            }

            ?>
        </div>
    </div>
</div>

<?php
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>