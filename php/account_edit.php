<?php
// Assuming you have a form that submits the user ID to be deleted
if (isset($_POST['id'])) {
  $userId = $_POST['id'];

  // Your code to delete the user account from the XML file
  // Example: Delete the user with the matching ID from the XML file
  $xmlFilePath = "../xml/accounts.xml";

  // Create a DOMDocument instance and load the XML file
  $doc = new DOMDocument();
  $doc->load($xmlFilePath);

  $xpath = new DOMXPath($doc);

  // Find the user with the matching ID
  $query = "//user[@id='$userId']";
  $userNode = $xpath->query($query)->item(0);

  if ($userNode) {
    // Remove the user node from the DOM
    if(isset($_REQUEST["email"])) {
        $userNode->email = $_REQUEST["email"];
    }
    if(isset($_REQUEST["username"])) {
        $userNode->username = $_REQUEST["username"];
    }
    if(isset($_REQUEST["password"])) {
        $userNode->password = $_REQUEST["password"];
    }
    // Save the updated XML file
    $doc->save($xmlFilePath);
    

    // Redirect to the account manager page after deletion
    echo "success";
    exit;
  }
}
?>
