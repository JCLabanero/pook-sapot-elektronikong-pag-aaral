<?php
$xmlDoc = new DOMDocument();
$xmlDoc -> load("../xml/accounts.xml");

$email = $_GET["email"];
$username = $_GET["username"];
$password = $_GET["password"];

$accounts = $xmlDoc.getElementsByTagName("account");
$newAccount = $accounts.createElement("account");

$newemail = $newAccount.createElement("email");
$newusername = $newAccount.createElement("username");
$password = $newAccount.createElement("password");

$newAccount.appendChild($newemail);

$xmlDoc.append
// $xmlDoc->saveXML();

?>