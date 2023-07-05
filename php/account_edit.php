<?php
// Assuming you have a form that submits the user ID to be deleted
if (isset($_REQUEST['id'])) {
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

  if($userNode){
    $message = "";
    if(isset($_REQUEST["email"])&&!empty($_REQUEST["email"])) {
      $userNode->getElementsByTagName('email')->item(0)->nodeValue = $_REQUEST["email"];
      $message .= "email, ";
    }
    if(isset($_REQUEST["username"])&&!empty($_REQUEST["username"])) {
      $userNode->getElementsByTagName('username')->item(0)->nodeValue = $_REQUEST["username"];
      $message .= "username, ";
    }
    if(isset($_REQUEST["password"])&&!empty($_REQUEST["password"])) {
      $password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);
      $userNode->getElementsByTagName('password')->item(0)->nodeValue = $password;
      $message .= "password, ";
    }
    // Save the updated XML file
    $doc->save($xmlFilePath);
  
    // Redirect to the account manager page after deletion
    echo $message . "updated successfully";
  } else {
    echo "user not found!";
    exit;
  }
}
?>
