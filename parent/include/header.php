<?php
require_once '../config.php';
if (!isset($_SESSION)) {
session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Automation System</title>
    <link rel="stylesheet" href="<?= $ROOT ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <header>
        <div class="logosec">
            <div class="logo">School <br>Automation System</div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>

        <div class="message">
            <div class="circle"></div>
            <?= $_SESSION['username'] ?>
            <div class="dp">

                <a href="<?= $ROOT ?>/logout.php">LOGOUT</a>
            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png" class="nav-img" alt="dashboard">
                        <a class="nav-text" href="<?= $ROOT ?>/parent/dashboard.php">Dashboard</a>
                    </div>

                    <div class="option1 nav-option">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png" class="nav-img" alt="articles">
                        <a class="nav-text" href="#">Class</a>
                    </div>

                    
                </div>
            </nav>
        </div>
        <div class="main">