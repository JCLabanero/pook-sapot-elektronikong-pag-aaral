<?php
session_start();

if (isset($_SESSION['user'])) {
    // Session is active
    header("Location: html/adminmenu.php");
    exit;
}
?>
