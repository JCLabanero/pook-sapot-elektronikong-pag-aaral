<?php
session_start();
// Assuming you have a form that submits the user ID to be updated
$userId = $_REQUEST["id"];
$userUsername = $_REQUEST["username"];
$userEmail = $_REQUEST["email"];
$userPassword = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);

// Your code to update the user account in the XML file
// Example: Update the user with the matching ID in the XML file
$xmlFilePath = "../xml/accounts.xml";

// Load the XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load($xmlFilePath); // Replace 'accounts.xml' with the path to your XML file

//Check if username is valid
if (validateUsername($userUsername) !== "") {
    echo validateUsername($userUsername);
    exit;
}
//Check if email is valid
if (!validateEmail($userEmail)) {
    echo "Email invalid";
    exit;
}

// Check if the username or email already exists
$users = $xml->getElementsByTagName("user");
foreach ($users as $user) {
    $existingUsername = $user->getElementsByTagName('username')->item(0)->nodeValue;
    $existingEmail = $user->getElementsByTagName('email')->item(0)->nodeValue;
    $existingId = $user->getAttribute('id');
    if ($existingId === $userId)
        continue;
    if ($existingUsername === $userUsername && $userUsername != "") {
        echo "Username already exists";
        exit;
    }
    if ($existingEmail === $userEmail && $userEmail != "") {
        echo "Email already exists";
        exit;
    }
}

// Loop through the user elements to find the one with the matching ID
foreach ($users as $user) {
    $idAttribute = $user->getAttribute('id');

    if ($idAttribute === $userId) {
        // Update the desired data within the user element
        $usernameValue = $user->getElementsByTagName('username')->item(0)->nodeValue;
        $emailValue = $user->getElementsByTagName('email')->item(0)->nodeValue;
        $passwordValue = $user->getElementsByTagName('password')->item(0)->nodeValue;

        if (strcasecmp($userUsername, $usernameValue) === 0) {
            echo "Username identical";
            exit;
        }
        if (strcasecmp($userEmail, $emailValue) === 0 && $userEmail != "") {
            echo "Email identical";
            exit;
        }
        if ($userPassword !== "") {
            if (password_verify($userPassword, $passwordValue)) {
                echo "Password identical";
                exit;
            }
        }

        $usernameElement = $user->getElementsByTagName('username')->item(0);
        $usernameElement->nodeValue = ($userUsername != "") ? $userUsername : $usernameValue;
        $_SESSION["username"] = $usernameElement->nodeValue;

        $passwordElement = $user->getElementsByTagName('password')->item(0);
        $passwordElement->nodeValue = ($userPassword != "") ? $userPassword : $passwordValue;

        $emailElement = $user->getElementsByTagName('email')->item(0);
        $emailElement->nodeValue = ($userEmail != "") ? $userEmail : $emailValue;
        $_SESSION["email"] = $emailElement->nodeValue;

        $xml->formatOutput = true;
        // Save the updated XML document
        $xml->save($xmlFilePath);
        $_SESSION["alert_message"] = "Account updated successfully";
        $response = "success";
        echo $response;
        exit; // Exit the loop since the user has been found
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
    if ($email == "")
        return true;
    return false;
}
function validateUsername($username)
{
    $minUsernameLength = 3; // Minimum length for username
    $maxUsernameLength = 20; // Maximum length for username

    // Regular expression to match alphanumeric characters, underscores, and hyphens
    $usernameRegex = '/^[a-zA-Z0-9_-]+$/';
    if ($username == "")
        return "";

    if (strlen($username) < $minUsernameLength || strlen($username) > $maxUsernameLength) {
        return "Username invalid: length must be 3-20 characters";
    }

    if (!preg_match($usernameRegex, $username)) {
        return "Username invalid: is limited with special characters";
    }


    return "";
}
