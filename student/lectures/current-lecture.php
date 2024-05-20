<?php
require_once '../../include/student-config.php';
require_once '../../include/header.php';
require_once '../../include/function.php';

$lecture = select('lectures', '*', 'book_id=' . $_GET['id']);
$book = select('book', '*', 'id=' . $_GET['id']);
?>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5 class="card-title text-center mt-4 font-weight-bold">List of <?= $book[0]['name'] ?> Lectures</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Lecture No</th>
                            <th>Lecture Title</th>
                            <th>Lecture</th>
                            <th>Lecture (Open / Close)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lecture as $value) {
                            $lec = select('lecture_schedule', '*', 'book_id=' . $value['book_id'] . ' AND lecture_id=' . $value['id']);
                            $isFutureLecture = true;
                            $isLectureScheduled = false;

                            foreach ($lec as $val) {
                                if ($val['lecture_date'] <= date('Y-m-d')) {
                                    $isFutureLecture = false;
                                    $isLectureScheduled = true;
                                    break;
                                }
                            }

                            $disableStyle = $isFutureLecture ? 'pointer-events: none; color: gray; text-decoration: none;' : '';
                            $colorStyle = $isFutureLecture ? 'text-danger' : ($isLectureScheduled ? 'text-success' : '');
                            $lectureStatus = $isFutureLecture ? 'Close' : ($isLectureScheduled ? 'Open' : 'Close');
                        ?>
                            <tr class="text-capitalize <?= $colorStyle ?>">
                                <td>Lecture No <?= $value['lecture_no'] ?></td>
                                <td><?= $value['lecture_title'] ?></td>
                                <td><a href="display.php?file=<?= $value['lecture'] ?>&id=<?= $value['id'] ?>" style="<?= $disableStyle ?>">View File</a></td>
                                <td><?= $lectureStatus ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../../include/footer.php';
?>