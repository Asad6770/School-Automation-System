<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';
        require_once 'C:\xampp\htdocs\SAS\include\function.php';
        $q = 'SELECT lecture_schedule.*, book.name AS book_name, teacher.fullname AS teacher_name
        FROM lecture_schedule
        INNER JOIN book ON book.id = lecture_schedule.book_id
        INNER JOIN teacher ON teacher.id = lecture_schedule.teacher_id
        where lecture_schedule.class_id = ' . $_SESSION['class_id'] . '
        ';
        $data = query($q);
        // print_r($data);

?>

        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-center">
                    <h5 class="card-title text-center mt-4 font-weight-bold">Lecture Schedule</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Teacher Name</th>
                                    <th>Subject</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($data as $value) {

                                    @$index += 1;
                                    echo ' 
                                    
                                        <input type="text" name="class_id" value=' . $value['class_id'] . ' hidden>
                                    <tr class="text-capitalize">
                                        <td>' . $index . '</td>
                                        <td>' . date_format(new DateTime($value['start_time']), 'h:i A') . '</td>
                                        <td>' . date_format(new DateTime($value['end_time']), 'h:i A') . '</td>           
                                        <td>' . $value['teacher_name'] . '</td>  
                                        <td>' . $value['book_name'] . '</td>  
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
        $days = ["1" => "Monday", "2" => "Tuesday", "3" => "Wednesday", "4" => "Thursday", "5" => "Friday", "6" => "Saturday", "7" => "Sunday"];

        $hours = "SELECT id, start_time FROM lecture_schedule";

        $timetable ="SELECT id, week_day, book_id FROM lecture_schedule";
print_r($hours);
        // SET UP SCHEDULE
        $schedule = [];

        foreach ($timetable as $tt) {
        $schedule[$tt->day][$tt->lecture_id][] = $tt->subject_id;
        }
        ?>

        <table border="1">
            <tr>
                <td align="center">Time</td>
                <?php foreach ($hours as $hour) : ?>
                    <td><?php echo $hour->start_time; ?></td>
                <?php endforeach; ?>
            </tr>

            <?php foreach ($days as $day => $dayName) : ?>
                <tr>
                    <td><?php echo $dayName; ?></td>
                    <?php foreach ($hours as $hour) : ?>
                        <td>
                            <?php
                            if (isset($schedule[$day][$hour->id])) {
                                foreach ($schedule[$day][$hour->id] as $subject) {
                                    echo "$subject<br>";
                                }
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>

<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>