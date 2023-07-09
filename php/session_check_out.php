<?php
session_start();

if (isset($_SESSION['id'])) {
    // Session is active
    header("Location: html/adminmenu.php");
    exit;
}
