<?php
  $userId = $_REQUEST['id'];

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

  var_dump($userNode);

  if ($userNode) {
    // Remove the user node from the DOM
    $userNode->parentNode->removeChild($userNode);

    // Save the updated XML file
    $doc->save($xmlFilePath);

    // Redirect to the account manager page after deletion
    header("Location: ../html/adminmenu.php");
    exit;
  }
?>
