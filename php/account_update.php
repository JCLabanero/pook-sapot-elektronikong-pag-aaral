<?php
session_start();
// Assuming you have a form that submits the user ID to be updated
if (isset($_REQUEST["id"])) {
    $userId = $_REQUEST["id"];
    $userUsername = $_REQUEST["username"];
    $userEmail = $_REQUEST["email"];

    // Your code to update the user account in the XML file
    // Example: Update the user with the matching ID in the XML file
    $xmlFilePath = "../xml/accounts.xml";

    // Create a DOMDocument instance and load the XML file
    $doc = new DOMDocument();
    $doc->load($xmlFilePath);

    $xpath = new DOMXPath($doc);

    // Find the user with the matching ID
    $query = "//user[@id='$userId']";
    $userNode = $xpath->query($query)->item(0);

    if ($userNode) {
        $message = "";
        if (isset($_REQUEST["email"]) && !empty($_REQUEST["email"])) {
            if (isExisting($_REQUEST["email"])) {
                $_SESSION["alert_message"] = "Email already exist!";
                toExit();
            }
            $userNode->getElementsByTagName('email')->item(0)->nodeValue = $userEmail;
            $message .= "email, ";
        }
        if (isset($userUsername) && !empty($userUsername)) {
            if (isExisting($userUsername)) {
                $_SESSION["alert_message"] = "Username already exist!";
                toExit();
            }
            $userNode->getElementsByTagName('username')->item(0)->nodeValue = $userUsername;
            $message .= "username, ";
        }
        if (isset($_REQUEST["password"]) && !empty($_REQUEST["password"])) {
            $password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);
            $userNode->getElementsByTagName('password')->item(0)->nodeValue = $password; // Use $password instead of $_REQUEST["username"]
            $message .= "password, ";
        }
        // Save the updated XML file
        $doc->save($xmlFilePath);
        // Redirect to the account manager page after updating
        $id = $userNode->getAttribute("id");
        $email = $userNode->getElementsByTagName('email')->item(0)->nodeValue;
        $username = $userNode->getElementsByTagName('username')->item(0)->nodeValue;
        $_SESSION["alert_message"] = $message . " updated successfully!";
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        header("Location: ../html/adminprofile.php?id=$id&email=$email&username=$username");
        exit;
    } else {
        echo "User not found!";
    }
    function toExit()
    {
        header("Location: ../html/adminprofile.php?id=$userId&email=$userEmail&username=$userUsername");
        exit;
    }
}
function isExisting($userAccount)
{
    // Load the XML file
    $xml = new DOMDocument();
    $xml->preserveWhiteSpace = false;
    $xml->load('../xml/accounts.xml'); // Replace 'accounts.xml' with the path to your XML file

    // Check if the username or email already exists
    $existingUser = $xml->getElementsByTagName('user');
    foreach ($existingUser as $user) {
        $existingUsername = $user->getElementsByTagName('username')->item(0)->nodeValue;
        $existingEmail = $user->getElementsByTagName('email')->item(0)->nodeValue;
        if ($existingEmail === $userAccount && $userAccount != "") {
            echo "Email already exists";
            return true;
        }
        if ($existingUsername === $userAccount && $userAccount != "") {
            echo "Username already exists";
            return true;
        }
    }
    return false;
}
function validateUsername($username)
{
    $minUsernameLength = 3; // Minimum length for username
    $maxUsernameLength = 20; // Maximum length for username

    // Regular expression to match alphanumeric characters, underscores, and hyphens
    $usernameRegex = '/^[a-zA-Z0-9_-]+$/';

    if (strlen($username) < $minUsernameLength || strlen($username) > $maxUsernameLength) {
        return false;
    }

    if (!preg_match($usernameRegex, $username)) {
        return false;
    }

    return true;
}
