<?php

require_once 'C:\xampp\htdocs\SAS\config.php';
if (!isset($_SESSION)) {
  session_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
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
        <i class="fas fa-school fa-2x text-white"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SAS</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?= $ROOT ?>/admin/dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Users</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item" href="<?= $ROOT ?>/admin/user/teacher.php">Teacher</a>
            <a class="collapse-item" href="<?= $ROOT ?>/admin/user/student.php">Student</a>
            <a class="collapse-item" href="<?= $ROOT ?>/admin/user/parent.php">Parent</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= $ROOT ?>/admin/class/index.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Class</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= $ROOT ?>/admin/subject/index.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Subject</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Logout
      </div>
      <li class="nav-item">
        <a class="nav-link" href="<?= $ROOT ?>/logout.php">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          <span>Logout</span>
        </a>
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
              <a class="nav-link dropdown-toggle">
                <!-- <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px"> -->
                <span class="ml-2 d-none d-lg-inline text-white text-capitalize">Welcom, mr <?= $_SESSION['username'] ?></span>
              </a>
            </li>
          </ul>
        </nav>