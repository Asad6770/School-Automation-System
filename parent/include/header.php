<?php
require_once '../config.php';
if (!isset($_SESSION)) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="<?= $ROOT ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $ROOT ?>/assets/css/dashboard.css" rel="stylesheet">
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
        <a class="nav-link" href="<?= $ROOT ?>/parent/feedback.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Feedback</span></a>
      </li>
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="<?= $ROOT ?>/parent/view-feedback.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Feedback View</span>
        </a>
      </li>
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
 
        