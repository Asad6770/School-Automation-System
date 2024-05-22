<?php

require_once 'config.php';
if (!isset($_SESSION)) {
  session_start();
}
$username = $_SESSION['username'];
$host = basename($_SERVER['REQUEST_URI']);
$title = str_replace("-", " ", $host);
json_encode(array('datetime' => date('Y-m-d H:i:s')));
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="<?= $ROOT ?>/assets/upload/logo.png" rel="icon">
  <title><?= ucwords(substr($title, 0, strpos(ucwords($title), ".php"))) ?></title>
  <script src="<?= $ROOT ?>assets/vendor/jquery/jquery.min.js"></script>
  <link href="<?= $ROOT ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>assets/css/style.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>assets/css/dashboard.css" rel="stylesheet">
  <link href="<?= $ROOT ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="<?= $ROOT ?>assets/js/ckeditor.js"></script>


</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
          <img src="<?= $ROOT ?>assets/upload/logo.png">
        </div>
        <div class="text-white mx-3">SAS</div>
      </a>
      <!-- admin options -->
      <?php if (substr($username, 0, 5) == "admin") { ?>
        <hr class="sidebar-divider my-0">
        <li class="nav-item <?= ($host == 'dashboard.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Features
        </div>
        <li class="nav-item <?= ($host === 'teacher.php' || $host === 'student.php' || $host === 'parent.php') ? 'active' : ''; ?>">
          <a class="nav-link <?= ($host === 'teacher.php' || $host === 'student.php' || $host === 'parent.php') ? '' : 'collapsed'; ?>
          " href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="<?= ($host === 'teacher.php' || $host === 'student.php' || $host === 'parent.php') ? 'true' : 'false'; ?>
          " aria-controls="collapseOne">
            <i class="fas fa-users fa-2x"></i>
            <span>Users</span>
          </a>
          <div id="collapseOne" class="collapse <?= ($host === 'teacher.php' || $host === 'student.php' || $host === 'parent.php') ? 'show' : ''; ?>" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manage</h6>
              <a class="collapse-item <?= ($host == 'teacher.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/user/teacher.php">
                <i class="fas fa-chalkboard-teacher"></i> Add Teacher
              </a>
              <a class="collapse-item <?= ($host == 'student.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/user/student.php">
                <i class="fas fa-user-graduate"></i> Add Student
              </a>
              <a class="collapse-item <?= ($host == 'parent.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/user/parent.php">
                <i class="fas fa-user"></i> Add Parent
              </a>
            </div>
          </div>
        </li>


        <li class="nav-item <?= ($host == 'class.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/class/class.php">
            <i class="fas fa-school"></i>
            <span>Class</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'book.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/book/book.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Book</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'create-schedule.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/lecture-schedule/create-schedule.php">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Lecture Schedule</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'course-selection.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/course-selection/course-selection.php">
            <i class="fas fa-clipboard-list"></i>
            <span>Course Selection</span>
          </a>
        </li>

        <li class="nav-item <?= ($host === 'fee.php' || $host === 'fee-voucher-generate.php' || $host === 'payment.php') ? 'active' : ''; ?>">
          <a class="nav-link <?= ($host === 'fee.php' || $host === 'fee-voucher-generate.php' || $host === 'payment.php') ? '' : 'collapsed'; ?>
          " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="<?= ($host === 'fee.php' || $host === 'fee-voucher-generate.php' || $host === 'payment.php') ? 'true' : 'false'; ?>
          " aria-controls="collapseTwo">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Student Fee</span>
          </a>
          <div id="collapseTwo" class="collapse <?= ($host === 'fee.php' || $host === 'fee-voucher-generate.php' || $host === 'payment.php') ? 'show' : ''; ?>" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Fee</h6>
              <a class="collapse-item <?= ($host === 'fee.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/fee/fee.php">
                <i class="fas fa-dollar-sign"></i>
                Add Fee
              </a>
              <div class="dropdown-divider"></div>
              <a class="collapse-item <?= ($host === 'fee-voucher-generate.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/fee/fee-voucher-generate.php">
                <i class="fas fa-ticket-alt"></i>
                Generate Fee Voucher
              </a>
              <div class="dropdown-divider"></div>
              <a class="collapse-item <?= ($host === 'payment.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/fee/payment.php">
                <i class="fas fa-receipt fa-sm fa-fw mr-2 text-gray-400"></i>
                Payment Status
              </a>
            </div>
          </div>
        </li>


        <li class="nav-item <?= ($host === 'create-result.php' || $host === 'marks-certificate.php' || $host === 'edit-marks.php') ? 'active' : ''; ?>">
          <a class="nav-link <?= ($host === 'create-result.php' || $host === 'marks-certificate.php' || $host === 'edit-marks.php') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="<?= ($host === 'create-result.php' || $host === 'marks-certificate.php' || $host === 'edit-marks.php') ? 'true' : 'false'; ?>" aria-controls="collapseSeven">
            <i class="fas fa-file-alt"></i>
            <span>Generate Reports</span>
          </a>
          <div id="collapseSeven" class="collapse <?= ($host === 'create-result.php' || $host === 'marks-certificate.php' || $host === 'edit-marks.php') ? 'show' : ''; ?>" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Reports</h6>
              <a class="collapse-item <?= ($host === 'create-result.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/reports/create-result.php">
                <i class="fas fa-poll"></i>
                Create Result
              </a>
              <div class="dropdown-divider"></div>
              <a class="collapse-item <?= ($host === 'marks-certificate.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>admin/reports/marks-certificate.php">
                <i class="fas fa-certificate"></i>
                DMC
              </a>
            </div>
          </div>
        </li>


        <li class="nav-item <?= ($host == 'teacher-attendance.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/attendance/teacher-attendance.php">
            <i class="fas fa-check"></i>
            <span>Teachers Attendance</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'salary.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/salary/salary.php">
            <i class="fas fa-dollar-sign"></i>
            <span>Teachers Salary</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'all-feedback.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>admin/all-feedback.php">
            <i class="fas fa-comments fa-2x"></i>
            <span>Parent Feedbacks</span>
          </a>
        </li>

        <!-- parent options -->
      <?php } else if (substr($username, 0, 2) == "pt") { ?>
        <hr class="sidebar-divider my-0">
        <li class="nav-item <?= ($host == 'feedback.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>parent/feedback.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Give Feedback</span></a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item <?= ($host == 'view-feedback.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>parent/view-feedback.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>View Feedback</span>
          </a>
        </li>

        <!-- student options -->
      <?php } else if (substr($username, 0, 2) == "st") { ?>

        <li class="nav-item <?= ($host == 'dashboard.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>student/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Features
        </div>
        <li class="nav-item <?= ($host == 'attendance.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>student/attendance.php">
            <i class="fas fa-user-check"></i>
            <span>View Attendance</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'fee-voucher.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>student/fee-voucher.php">
            <i class="fas fa-receipt"></i>
            <span>Fee Detail</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'course-selection.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>student/course-selection.php">
            <i class="fas fa-clipboard-list"></i>
            <span>Course Selection</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'lecture-schedule.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>student/lecture-schedule.php">
            <i class="fas fa-chalkboard"></i>
            <span>Lecture Schedule</span>
          </a>
        </li>

        <!-- teacher options -->
      <?php } else if (substr($username, 0, 2) == "tc") { ?>
        <li class="nav-item <?= ($host === 'dashboard.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>teacher/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Features
        </div>

        <li class="nav-item <?= ($host === 'mark-attendance.php' || $host === 'attendance-report.php') ? 'active' : ''; ?>">
          <a class="nav-link <?= ($host === 'mark-attendance.php' || $host === 'attendance-report.php') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="<?= ($host === 'mark-attendance.php' || $host === 'attendance-report.php') ? 'true' : 'false'; ?>" aria-controls="collapseThree">
            <i class="fas fa-user-check"></i>
            <span>Attendance</span>
          </a>
          <div id="collapseThree" class="collapse <?= ($host === 'mark-attendance.php' || $host === 'attendance-report.php') ? 'show' : ''; ?>" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manage</h6>
              <a class="collapse-item <?= ($host === 'mark-attendance.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>teacher/attendance/mark-attendance.php"><i class="fas fa-check"></i> Mark Attendance</a>
              <a class="collapse-item <?= ($host === 'attendance-report.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>teacher/attendance/attendance-report.php"><i class="fas fa-file"></i> Attendance Report</a>
            </div>
          </div>
        </li>


        <li class="nav-item <?= ($host === 'create-assignment.php' || $host === 'submitted-assignment.php') ? 'active' : ''; ?>">
          <a class="nav-link <?= ($host === 'create-assignment.php' || $host === 'submitted-assignment.php') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="<?= ($host === 'create-assignment.php' || $host === 'submitted-assignment.php') ? 'true' : 'false'; ?>" aria-controls="collapseFour">
            <i class="fas fa-file-alt"></i>
            <span>Assignment</span>
          </a>
          <div id="collapseFour" class="collapse <?= ($host === 'create-assignment.php' || $host === 'submitted-assignment.php') ? 'show' : ''; ?>" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Users</h6>
              <a class="collapse-item <?= ($host === 'create-assignment.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>teacher/assignment/create-assignment.php"> <i class="fas fa-pencil-alt"></i> Create Assignment</a>
              <a class="collapse-item <?= ($host === 'submitted-assignment.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>teacher/assignment/submitted-assignment.php"><i class="fas fa-check-circle"></i> Submitted Assignments</a>
            </div>
          </div>
        </li>


        <li class="nav-item <?= ($host === 'quiz.php' || $host === 'question.php' || $host === 'attempted-quiz.php') ? 'active' : ''; ?>">
          <a class="nav-link <?= ($host === 'quiz.php' || $host === 'question.php' || $host === 'attempted-quiz.php') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="<?= ($host === 'quiz.php' || $host === 'question.php' || $host === 'attempted-quiz.php') ? 'true' : 'false'; ?>" aria-controls="collapseSix">
            <i class="fas fa-question-circle"></i>
            <span>Quiz</span>
          </a>
          <div id="collapseSix" class="collapse <?= ($host === 'quiz.php' || $host === 'question.php' || $host === 'attempted-quiz.php') ? 'show' : ''; ?>" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manage</h6>
              <a class="collapse-item <?= ($host === 'quiz.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>teacher/quiz/quiz.php"><i class="fas fa-pencil-alt"></i> Create Quiz</a>
              <a class="collapse-item <?= ($host === 'question.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>teacher/quiz/question.php"><i class="fas fa-database"></i> Question Bank</a>
              <a class="collapse-item <?= ($host === 'attempted-quiz.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>teacher/quiz/attempted-quiz.php"><i class="fas fa-check-circle"></i> Attempted Quizzes</a>
            </div>
          </div>
        </li>


        <li class="nav-item <?= ($host == 'lectures.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>teacher/lectures/lectures.php">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Lectures</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'view-schedule.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>teacher/view-schedule.php">
            <i class="fas fa-chalkboard"></i>
            <span>Lecture Schedule</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'salary-slip.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>teacher/salary-slip.php">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Salary Slip</span>
          </a>
        </li>

      <?php } ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Setting
      </div>

      <li class="nav-item <?= ($host === 'change-password.php' or $host === 'logout.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapse">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Setting</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Setting</h6>
            <a class="collapse-item <?= ($host === 'change-password.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>change-password.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="collapse-item" href="<?= $ROOT ?>logout.php">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </div>
      </li>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
              <span class="ml-2 text-white text-capitalize" id="currentDateTime"></span>
            </li>
            <div class="topbar-divider"></div>
            <li class="nav-item ">
              <span class="ml-2 text-white text-capitalize">Welcom, <?= $_SESSION['fullname'] ?></span>
            </li>
          </ul>
        </nav>

        <script>
          $(document).ready(function() {
            function updateDateTime() {
              var currentTime = new Date();
              var hours = currentTime.getHours();
              var minutes = currentTime.getMinutes();
              var seconds = currentTime.getSeconds();
              var day = currentTime.getDate();
              var month = currentTime.toLocaleString('default', {
                month: 'short'
              }).toUpperCase();
              var year = currentTime.getFullYear();

              var ampm = hours >= 12 ? 'PM' : 'AM';
              hours = hours % 12;
              hours = hours ? hours : 12; // Handle midnight (0 hours)

              // Add leading zeros if needed
              minutes = (minutes < 10 ? "0" : "") + minutes;
              seconds = (seconds < 10 ? "0" : "") + seconds;
              day = (day < 10 ? "0" : "") + day;

              // Format the time and date
              var timeString = hours + ":" + minutes + ":" + seconds + " " + ampm;
              var dateString = day + "-" + month + "-" + year;

              // Update the HTML with the new time and date
              $("#currentDateTime").html(timeString + " / " + dateString);
            }

            // Update the date and time every second
            setInterval(updateDateTime, 1000);
          });
        </script>