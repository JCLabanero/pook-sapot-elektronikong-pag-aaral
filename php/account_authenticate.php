<?php
session_start();
// Read the submitted form data
$usernameOrEmail = $_REQUEST["usernameOrEmail"];
$password = $_REQUEST["password"];

if ($usernameOrEmail == NULL || $password == NULL) {
    createResponse(401, "The requested page needs a username and a password.");
    return false;
}

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
            createResponse(200, "Login successfully.");
            //set session
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $id;
            exit;
        } else {
            createResponse(102, "Password Incorrect.");
            exit;
        }
    }
}

if (!$existingUser) {
    createResponse(101, "User not found.");
    exit;
}
function createResponse($code, $message)
{
    $response = [
        "status" => $code,
        "message" => "$message"
    ];
    echo json_encode($response);
}
