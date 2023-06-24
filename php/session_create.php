<?php
session_start();
$thisuser = $_REQUEST["user"];
//Create session, quite dumb, redundant
$_SESSION["user"] = $thisuser;
?>