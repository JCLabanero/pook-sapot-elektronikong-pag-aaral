<?php
session_start();
// Assuming you have a form that submits the user ID to be updated
// $data["id] = $_REQUEST["id"];
// $data["username"] = $_REQUEST["username"];
// $data["email"] = $_REQUEST["email"];
// $userPassword = null;

$data = array(
    "id" => $_REQUEST["id"],
    "username" => $_REQUEST["username"],
    "email" => $_REQUEST["email"],
    "password" => $_REQUEST["password"],
);
$errorFields = [];
$successFields = [];

foreach ($data as $key => $value) {
    if (empty($value))
        $errorFields[] = $key;
}

if (!empty($errorFields))
    returnRequest(400, "Fields are required.", [], $errorFields);

if (!empty(validateUsername($data["username"]))) {
    returnRequest(400, validateUsername($data["username"]));
}
//Check if email is valid
if (!validateEmail($data["email"])) {
    returnRequest(400, "Invalid Email");
}

// Your code to update the user account in the XML file
// Example: Update the user with the matching ID in the XML file
$xmlFilePath = "../xml/accounts.xml";

// Load the XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load($xmlFilePath); // Replace 'accounts.xml' with the path to your XML file

//Check if username is valid

// Check if the username or email already exists
$users = $xml->getElementsByTagName("user");
foreach ($users as $user) {
    $username = $user->getElementsByTagName('username')->item(0)->nodeValue;
    $email = $user->getElementsByTagName('email')->item(0)->nodeValue;
    $id = $user->getAttribute('id');
    if ($id == $data["id"])
        continue;
    if (strcasecmp($username, $data["username"]) === 0)
        $errorFields[] = "username";
    if (strcasecmp($email, $data["email"]) === 0)
        $errorFields[] = "email";
    if (!empty($errorFields))
        returnRequest(400, "Field(s) already exists.", [], $errorFields);
}

// Loop through the user elements to find the one with the matching ID
foreach ($users as $user) {
    $id = $user->getAttribute('id');

    if ($id === $data["id"]) {
        // Update the desired data within the user element
        $username = $user->getElementsByTagName('username')->item(0)->nodeValue;
        $email = $user->getElementsByTagName('email')->item(0)->nodeValue;
        $password = $user->getElementsByTagName('password')->item(0)->nodeValue;

        if (strcasecmp($data["username"], $username) === 0)
            $errorFields[] = "username";
        if (strcasecmp($data["email"], $email) === 0 && $data["email"] != "")
            $errorFields[] = "email";
        if (password_verify($data["password"], $password))
            $errorFields[] = "password";
        if (!empty($errorFields))
            returnRequest(400, "Field(s) are identical.", [], $errorFields);

        $usernameElement = $user->getElementsByTagName('username')->item(0);
        $usernameElement->nodeValue = $data["username"];
        $emailElement = $user->getElementsByTagName('email')->item(0);
        $emailElement->nodeValue = $data["email"];

        $_SESSION["username"] = $usernameElement->nodeValue;
        $_SESSION["email"] = $emailElement->nodeValue;

        $passwordElement = $user->getElementsByTagName('password')->item(0);
        $passwordElement->nodeValue = password_hash($data["password"], PASSWORD_DEFAULT);

        $xml->formatOutput = true;
        // Save the updated XML document
        $xml->save($xmlFilePath);
        returnRequest(200, "Account updated successfully.");
    }
}
function validateEmail($email)
{
    // Regular expression pattern for email validation
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    // Use preg_match to perform the validation
    if (preg_match($pattern, $email)) {
        return true; // Email is valid
    }
    return false;
}
function validateUsername($username)
{
    $return = null;
    $minUsernameLength = 3; // Minimum length for username
    $maxUsernameLength = 20; // Maximum length for username

    // Regular expression to match alphanumeric characters, underscores, and hyphens
    $usernameRegex = '/^[a-zA-Z0-9_-]+$/';

    if (strlen($username) < $minUsernameLength || strlen($username) > $maxUsernameLength) {
        $return = "Username invalid: length must be 3-20 characters";
    }

    if (!preg_match($usernameRegex, $username)) {
        $return = "Username invalid: is limited with special characters";
    }


    return $return;
}

function returnRequest($code, $message, $successFields = [], $errorFields = [])
{
    $response = [
        "status" => $code,
        "message" => $message,
        "successFields" => $successFields,
        "errorFields" => $errorFields,
    ];
    echo json_encode($response);
    exit;
}
