<?php

require_once 'C:\xampp\htdocs\SAS\config.php';
if (!isset($_SESSION)) {
  session_start();
}
$username = $_SESSION['username'];
$host = basename($_SERVER['REQUEST_URI']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="<?= $ROOT ?>/assets/upload/logo.png" rel="icon">
  <title >
    
  <?= ucwords(substr($host, 0, strpos($host, ".php")))?></title>
  <link href="<?= $ROOT ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>/assets/css/dashboard.css" rel="stylesheet">
  <link href="<?= $ROOT ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="<?= $ROOT ?>/assets/js/ckeditor.js"></script>

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
          <img src="<?= $ROOT ?>/assets/upload/logo.png">
        </div>
        <div class="text-white mx-3">SAS</div>
      </a>
      <!-- admin options -->
      <?php if (substr($username, 0, 5) == "admin") { ?>
        <hr class="sidebar-divider my-0">
        <li class="nav-item <?= ($host == 'dashboard.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/admin/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Features
        </div>
        <li class="nav-item <?= ($host === 'teacher.php' or $host === 'student.php' or $host === 'parent.php') ? 'active' : ''; ?>">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapse">
            <i class="fas fa-users fa-2x"></i>
            <span>Users</span>
          </a>
          <div id="collapseOne" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manage</h6>
              <a class="collapse-item <?= ($host == 'teacher.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/user/teacher.php">Add Teacher</a>
              <a class="collapse-item <?= ($host == 'student.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/user/student.php">Add Student</a>
              <a class="collapse-item <?= ($host == 'parent.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/user/parent.php">Add Parent</a>
            </div>
          </div>
        </li>

        <li class="nav-item <?= ($host == 'class.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/admin/class/class.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Class</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'book.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/admin/book/book.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Book</span>
          </a>
        </li>

        <li class="nav-item <?= ($host === 'fee.php' or $host === 'fee-voucher.php' or $host === 'payment.php') ? 'active' : ''; ?>">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapse">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Student Fee</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Fee</h6>
              <a class="collapse-item <?= ($host === 'fee.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/fee/fee.php">
                <i class="fas fa-money-bill fa-sm fa-fw mr-2 text-gray-400"></i>
                Add Fee
              </a>
              <div class="dropdown-divider"></div>
              <a class="collapse-item <?= ($host === 'fee-voucher.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/fee/fee-voucher.php">
                <i class="fas fa-receipt fa-sm fa-fw mr-2 text-gray-400"></i>
                Generate Fee Voucher
              </a>
              <div class="dropdown-divider"></div>
              <a class="collapse-item <?= ($host === 'payment.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/fee/payment.php">
                <i class="fas fa-receipt fa-sm fa-fw mr-2 text-gray-400"></i>
                Payment Status
              </a>
            </div>
          </div>
        </li>

        <li class="nav-item <?= ($host == 'salary.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/admin/salary/salary.php">
            <i class="fas fa-user fa-2x"></i>
            <span>Teachers Salary</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'all-feedback.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/admin/all-feedback.php">
            <i class="fas fa-user fa-2x"></i>
            <span>Parent Feedbacks</span>
          </a>
        </li>

        <!-- parent options -->
      <?php } else if (substr($username, 0, 2) == "pt") { ?>
        <hr class="sidebar-divider my-0">
        <li class="nav-item <?= ($host == 'feedback.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/parent/feedback.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Give Feedback</span></a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item <?= ($host == 'view-feedback.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/parent/view-feedback.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>View Feedback</span>
          </a>
        </li>

        <!-- student options -->
      <?php } else if (substr($username, 0, 2) == "st") { ?>

        <li class="nav-item <?= ($host == 'dashboard.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/student/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Features
        </div>
        <li class="nav-item <?= ($host == 'attendance.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/student/attendance.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>View Attendance</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'fee-voucher.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/student/fee-voucher.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>View Fee Voucher</span>
          </a>
        </li>

        <li class="nav-item <?= ($host == 'course-selection.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/student/course-selection.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Course Selection</span>
          </a>
        </li>

        <!-- teacher options -->
      <?php } else if (substr($username, 0, 2) == "tc") { ?>
        <li class="nav-item <?= ($host === 'dashboard.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/teacher/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Features
        </div>

        <li class="nav-item <?= ($host === 'mark-attendance.php' or $host === 'attendance-report.php') ? 'active' : ''; ?>">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapse">
            <i class="fas fa-users fa-2x"></i>
            <span>Attendance</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manage</h6>
              <a class="collapse-item <?= ($host === 'mark-attendance.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/teacher/attendance/mark-attendance.php">Mark Attendance</a>
              <a class="collapse-item <?= ($host === 'attendance-report.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/teacher/attendance/attendance-report.php">View Attendance Report</a>
            </div>
          </div>
        </li>

        <li class="nav-item <?= ($host === 'create-assignment.php' or $host === 'submitted-assignment.php') ? 'active' : ''; ?>">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapse">
            <i class="fas fa-users fa-2x"></i>
            <span>Assignments</span>
          </a>
          <div id="collapseFour" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Users</h6>
              <a class="collapse-item <?= ($host == 'create-assignment.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/teacher/assignment/create-assignment.php">Add New Assignments</a>
              <a class="collapse-item <?= ($host === 'submitted-assignment.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/teacher/assignment/submitted-assignment.php">View Assignments</a>
            </div>
          </div>
        </li>

        <li class="nav-item <?= ($host == 'salary-slip.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="<?= $ROOT ?>/teacher/salary-slip.php">
            <i class="fas fa-fw fa-chart-area"></i>
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
            <a class="collapse-item <?= ($host === 'change-password.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/change-password.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="collapse-item" href="<?= $ROOT ?>/logout.php">
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
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-2 d-none d-lg-inline text-white text-capitalize">Welcom, <?= $_SESSION['fullname'] ?></span>
              </a>
            </li>
          </ul>
        </nav>
