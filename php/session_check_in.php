<?php
session_start();

if ($_SESSION["logged_in"]==false) {
    // Session is active
    header("Location: ../index.php");
    exit;
} else {
}
?>
