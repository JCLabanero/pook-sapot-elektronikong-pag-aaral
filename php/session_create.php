<?php
session_start();
if(isset($_REQUEST["user"]))
{
    $_SESSION["user"] = $_REQUEST["user"];
}
if(isset($_REQUEST["email"]))
{
    $_SESSION["email"] = $_REQUEST["email"];
}
if(isset($_REQUEST["id"]))
{
    $_SESSION["id"] = $_REQUEST["id"];
}
?>