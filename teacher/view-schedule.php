<?php
require_once '../include/teacher-config.php';
require_once '../include/header.php';
require_once '../include/function.php';

$sql = 'SELECT lecture_schedule.*, book.name AS book_name, class.name AS class_name, lectures.lecture_no AS lec_no 
FROM lecture_schedule INNER JOIN book ON book.id = lecture_schedule.book_id 
INNER JOIN lectures ON lectures.id = lecture_schedule.lecture_id INNER JOIN class ON class.id = lecture_schedule.class_id
where lecture_schedule.teacher_id = ' . $_SESSION['id'] . ' ORDER BY lecture_schedule.id ASC';

$data = query($sql);
$class = select('class', '*');
// print_r($data);
?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center font-weight-bold mt-4">Lecture Schedule</h5>
        </div>
        <div class="card-body">
            <?php
            if (@$data > 0) {
                echo '<div class="container-fluid">
                        <table class="table table-bordered text-center">
                            <thead class="thead-light">
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
                    $lecture_no = $value['lec_no']; 
                    
                    $lecture_schedule[$day][$start_time] = "<span>$book</span> <br> <strong>Lecture $lecture_no</strong> <br> <span>$start_time - $end_time</span>";
                }
                
                $times = array('07:45', '08:30', '09:15', '10:00', '10:45', '11:30', '12:00', '12:45', '13:30');
                foreach ($times as $time) {
                    echo '<tr>
                            <th class="align-middle" style="background-color: #f2f2f2;">' . $time . '</th>';
                    foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) {
                        if ($time == '11:30') {
                            echo '<td class="align-middle font-weight-bold" colspan="6" style="height: 100px; width: 200px; background-color: #f2f2f2;">Break (11:30 - 12:00)</td>';
                            break;
                        } else {
                            echo '<td class="align-middle" style="height: 100px; width: 200px;">';
                            echo isset($lecture_schedule[$day][$time]) ? $lecture_schedule[$day][$time] : '';
                            echo '</td>';
                        }
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
require_once '../include/footer.php';
?>