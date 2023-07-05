<?php
error_log('PHP script called'); // Check the server's error log for this message
session_start();

if (isset($_REQUEST["email"])&&isset($_REQUEST["username"])) {
  $_SESSION["toUdEmail"] = $_REQUEST["email"];
  $_SESSION["toUdUser"] = $_REQUEST["username"];
}
?>