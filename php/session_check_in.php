<?php
session_start();

if (!isset($_SESSION["id"])) {
    // Session is active
    header("Location: ../index.php");
    exit;
}
