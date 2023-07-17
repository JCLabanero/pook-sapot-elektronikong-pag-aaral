<?php
session_start();
// Read the submitted form data
$usernameOrEmail = $_REQUEST["usernameOrEmail"];
$password = $_REQUEST["password"];

if (empty($usernameOrEmail) && empty($password))
    echo returnRequest(400, "Fields are required", ["fields"]);
if (empty($usernameOrEmail))
    echo returnRequest(400, "Username required", ["username"]);
if (empty($password))
    echo returnRequest(400, "Password required", ["password"]);

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
            returnRequest(403, "Password Incorrect.");
        }
    }
}
if (!$existingUser) {
    returnRequest(404, "User not found.");
}
function returnRequest($code, $message, $missingFields = [])
{
    $response = [
        "status" => $code,
        "message" => $message,
        "missingFields" => $missingFields
    ];
    echo json_encode($response);
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
