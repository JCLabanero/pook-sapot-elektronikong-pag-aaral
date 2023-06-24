<?php
session_start();

if (isset($_SESSION['user'])||isset($_SESSION['logged_in'])) {
    // Session is active
    echo "active";
} else {
    // Session is not active
    echo "inactive";
}
?>
