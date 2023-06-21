<?php
session_start();

if (isset($_SESSION['username'])) {
    // Session is active
    echo "active";
} else {
    // Session is not active
    echo "inactive";
}
?>
