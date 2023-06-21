<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Session is active
    // header("Location: ../index.php");
    
    echo "Session is active for user: " . $_SESSION['username'];
}
?>
