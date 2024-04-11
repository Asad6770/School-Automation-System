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
  <title>School Automation System</title>
  <link href="<?= $ROOT ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>/assets/css/dashboard.css" rel="stylesheet">
  <link href="<?= $ROOT ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="<?= $ROOT ?>/assets/upload/logo.png">
        </div>
        <div class="sidebar-brand-text mx-3">SAS</div>
      </a>
      <!-- admin options -->
      <?php  if (substr($username, 0, 5) == "admin") { ?>
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
          <i class="fas fa-users fa-2x"></i>
          <span>Users</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item <?= ($host == 'teacher.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/user/teacher.php">Teacher</a>
            <a class="collapse-item <?= ($host == 'student.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/user/student.php">Student</a>
            <a class="collapse-item <?= ($host == 'parent.php') ? 'active' : ''; ?>" href="<?= $ROOT ?>/admin/user/parent.php">Parent</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= ($host == 'class.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $ROOT ?>/admin/class/class.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Class</span>
        </a>
      </li>

      <li class="nav-item <?= ($host == 'subject.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $ROOT ?>/admin/subject/subject.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Subject</span>
        </a>
      </li>

      <li class="nav-item <?= ($host == 'fee.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $ROOT ?>/admin/fee/fee.php">
          <i class="fas fa-fw fa-money-bill"></i>
          <span>Fee</span>
        </a>
      </li>

      <li class="nav-item <?= ($host == 'all-feedback.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $ROOT ?>/admin/all-feedback.php">
          <i class="fas fa-fw fa-money-bill"></i>
          <span>Parent Feedbacks</span>
        </a>
      </li>
     
      <!-- parent options -->
      <?php }else if (substr($username, 0, 2) == "pt") {?>
      <hr class="sidebar-divider my-0">
      <li class="nav-item <?= ($host == 'feedback.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $ROOT ?>/parent/feedback.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Feedback</span></a>
      </li>
      <hr class="sidebar-divider">

      <li class="nav-item <?= ($host == 'view-feedback.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $ROOT ?>/parent/view-feedback.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Feedback View</span>
        </a>
      </li>

      <!-- student options -->
      <?php }else if (substr($username, 0, 2) == "st") {?>
        
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
          <span>Attendance Report</span>
        </a>
      </li>

      <!-- teacher options -->
      <?php }else if (substr($username, 0, 2) == "tc") {?>
      <li class="nav-item">
        <a class="nav-link" href="<?= $ROOT ?>/teacher/dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>

      <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
          <i class="fas fa-users fa-2x"></i>
          <span>Attendance</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item" href="<?= $ROOT ?>/teacher/attendance/index.php">Mark Attendance</a>
            <a class="collapse-item" href="<?= $ROOT ?>/teacher/attendance/view.php">View Attendance</a>
          </div>
        </div>
      </li>
      <?php }?>
      <hr class="sidebar-divider">
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
                <span class="ml-2 d-none d-lg-inline text-white text-capitalize">Welcom, mr <?= $_SESSION['fullname'] ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= $ROOT ?>/logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>