<?php
session_start();

if (!isset($_SESSION["user"])) {
    // Session is active
    header("Location: ../index.php");
    exit;
}
?>
