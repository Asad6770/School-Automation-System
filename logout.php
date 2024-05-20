<?php
include_once 'include/config.php';
session_start();

session_unset();
session_destroy();
header("Location: " . $ROOT);
exit();