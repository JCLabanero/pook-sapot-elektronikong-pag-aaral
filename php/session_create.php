<?php
session_start();

$user = $_REQUEST['user'];
$_SESSION['user'] = $user;
$_SESSION["logged_in"] = true;

// if (isset($_SESSION['user'])) {
//     // Session is active
//     echo "active";
// } else {
//     // Session is not active
//     echo "inactive";
// }
?>
