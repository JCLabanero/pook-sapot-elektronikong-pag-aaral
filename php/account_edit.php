<?php
// Assuming you have a form that submits the user ID to be updated
if (isset($_REQUEST["id"])) {
    $userId = $_REQUEST["id"];

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
        if (isset($_REQUEST["email"]) && !empty($_REQUEST["email"])) {
            $userNode->getElementsByTagName('email')->item(0)->nodeValue = $_REQUEST["email"];
        }
        if (isset($_REQUEST["username"]) && !empty($_REQUEST["username"])) {
            $userNode->getElementsByTagName('username')->item(0)->nodeValue = $_REQUEST["username"];
        }
        if (isset($_REQUEST["password"]) && !empty($_REQUEST["password"])) {
            $password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);
            $userNode->getElementsByTagName('password')->item(0)->nodeValue = $password; // Use $password instead of $_REQUEST["username"]
        }
        // Save the updated XML file
        $doc->save($xmlFilePath);

        // Redirect to the account manager page after updating
        $id = $userNode->getAttribute("id");
        $email = $userNode->getElementsByTagName('email')->item(0)->nodeValue;
        $username = $userNode->getElementsByTagName('username')->item(0)->nodeValue;
        header("Location: ../html/admineditaccount.php?id=$id&email=$email&username=$username");
        exit;
    } else {
        echo "User not found!";
    }
}
?>
