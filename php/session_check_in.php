<?php
session_start();

if (isset($_SESSION['username'])) {
    // Session is active
    // header("Location: html/adminmenu.php");
    echo "Session is active for user: " . $_SESSION['username'];
}
?>
