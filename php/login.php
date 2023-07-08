<?php
session_start();
// Read the submitted form data
$usernameOrEmail = $_REQUEST["usernameOrEmail"];
$password = $_REQUEST["password"];

// Your code to validate the login credentials
// Example: Check if the username or email and password match an existing user in the XML
$existingUser = false;
$xml = new DOMDocument();
$xml->load("../xml/accounts.xml");

$users = $xml->getElementsByTagName("user");
foreach ($users as $user) {
    $username = $user->getElementsByTagName("username")[0]->nodeValue;
    $email = $user->getElementsByTagName("email")[0]->nodeValue;
    $storedPassword = $user->getElementsByTagName("password")[0]->nodeValue;
    $id = $user->getAttribute("id");

    if (strcasecmp($usernameOrEmail, $username) === 0 || strcasecmp($usernameOrEmail, $email) === 0) {
        $existingUser = true;
        if (password_verify($password, $storedPassword)) {
            echo "success";
            $_SESSION["user"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $id;
            exit;
        } else {
            echo "Incorrect password.";
            exit;
        }
    }
}

if (!$existingUser) {
    echo "User not found.";
    exit;
}
?>
