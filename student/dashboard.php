<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        header("Location: http://localhost:90/sas/not-allowed.php");
    } else {
        require_once 'C:\xampp\htdocs\SAS\include\header.php';

        require_once 'C:\xampp\htdocs\SAS\include\function.php';

        $total_days = "SELECT COUNT(*) AS student_count FROM attendance WHERE student_id =" . $_SESSION['id'] . "";
        $total_days = query($total_days);
        $totalWorkingDays = $total_days[0]['student_count'];

        $total_present = "SELECT COUNT(*) AS student_present FROM attendance WHERE student_id =" . $_SESSION['id'] . " AND attendance_status = 'present'";
        $total_present = query($total_present);
        $totalPresentDays = $total_present[0]['student_present'];
        if ($totalWorkingDays && $totalPresentDays > 0) {
            $percentage =  ($totalPresentDays / $totalWorkingDays) * 100;
        } else {
            $percentage = '';
        }

        $q = 'SELECT courses.*, book.name as book_name from courses INNER JOIN book ON book.id = courses.book_id
         where courses.student_id = ' . $_SESSION['id'] . '';
        // echo $q;
        $data = query($q);
        // print_r($q);
        // exit();


?>

        <div class="container-fluid" id="container-wrapper">
            <div class="row mb-3">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Attendance Percentage ( % )</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $percentage . ' %'; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                        <span>Since last years</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New User Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                                        <span>Since last month</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                        <span>Since yesterday</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-5">
            <?php
            if (@$data > 0) {
                foreach ($data as $value) {
                    $where = 'due_date >' . date('Y-m-d') . ' AND ' . 'book_id =' . $value['book_id'];
                    $notifications_quiz = select('quiz', '*', $where);
 
                    $notifications_assignment = select('assignment', '*', $where);
            ?>

                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white text-center">
                                <h5 class="mb-0 font-weight-bold text-uppercase"><?= $value['book_name'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <img src="<?= $ROOT ?>/assets/upload/assignment.png" width="70" height="70" alt="">
                                        <hr>
                                        <a class="font-weight-bold text-decoration-none text-dark" href="
                                        <?= $ROOT . '/student/assignment/assignment.php?id=' . $value['book_id'] . '' ?>">Assignment</a>
                                        <span class="<?= (count($notifications_assignment) != 0) ? 'badge badge-danger badge-counter' : '' ?>">
                                            <?= (count($notifications_assignment) != 0) ? count($notifications_assignment) : '' ?></span>
                                    </div>
                                    <div class="col-4 text-center">
                                        <img src="<?= $ROOT ?>/assets/upload/quiz.png" width="70" height="70" alt="">
                                        <hr>
                                        <a class="font-weight-bold text-decoration-none text-dark" href="
                                        <?= $ROOT . '/student/quiz/quiz.php?id=' . $value['book_id'] . '' ?>">Quiz</a>
                                        <span class="<?= (count($notifications_quiz) != 0) ? 'badge badge-danger badge-counter' : '' ?>">
                                            <?= (count($notifications_quiz) != 0) ? count($notifications_quiz) : '' ?></span>
                                    </div>
                                    <div class="col-4 text-center">
                                        <img src="<?= $ROOT ?>/assets/upload/lecture.png" width="70" height="70" alt="">
                                        <hr>
                                        Lecture 1
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'C:\xampp\htdocs\SAS\include\footer.php';
?>


<script>
    function fetchNotifications() {
        $.ajax({
            url: 'dashboard.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    // Clear existing notifications
                    $('#notifications').empty();

                    // Display new notifications
                    response.forEach(function(notification) {
                        $('#notifications').append('<li>' + notification.message + '</li>');
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notifications:', error);
            }
        });
    }

    // Call fetchNotifications initially and then every 30 seconds
    fetchNotifications();
    setInterval(fetchNotifications, 30000);
</script>