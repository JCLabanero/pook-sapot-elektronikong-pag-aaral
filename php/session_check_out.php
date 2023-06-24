<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true) {
    // Session is active
    header("Location: html/adminmenu.php");
}
?>
