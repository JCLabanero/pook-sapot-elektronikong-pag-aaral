<?php
session_start();

$user = $_GET['user'];
$_SESSION['user'] = $user;

if (isset($_SESSION['user'])) {
    // Session is active
    // header("Location: html/adminmenu.php");
    // echo "Session is active for user: " . $_SESSION['username'];
    echo "active";
} else {
    // Session is not active
    echo "inactive";
}
?>
