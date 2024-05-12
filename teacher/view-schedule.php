<?php
 require_once 'C:\xampp\htdocs\SAS\include\teacher-config.php';
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';
if (isset($_POST['class_id'])) {
    $class_Id = $_POST['class_id'];
} else {
    $class_Id = 1;
}

        $sql = 'SELECT lecture_schedule.*, book.name AS book_name, teacher.fullname AS teacher_name
        FROM lecture_schedule INNER JOIN book ON book.id = lecture_schedule.book_id
        INNER JOIN teacher ON teacher.id = lecture_schedule.teacher_id
        where lecture_schedule.class_id = '.$class_Id .' ORDER BY lecture_date, start_time';
        $data = query($sql);
        $class = select('class', '*');
?>

        <div class="container-fluid">
            <div class="card mb-4">
                <form action="" method="post">
                    <div class="card-header d-flex flex-row mt-3 align-items-center justify-content-center">
                        <div class="form-group col-3">
                            <select class="form-control" name="class_id" id="class_id" required>
                                <option value="">Select Class</option>
                                <?php foreach ($class as $value) {
                                    echo '<option value="' . $value['id'] . '">Class ' . $value['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-1">
                            <button class="form-control btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <?php
                    if (@$data > 0) {

                        echo '
                            <div class="container ">
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