<?php
session_start();
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
  $message = "";
  if (isset($_REQUEST["email"]) && !empty($_REQUEST["email"])) {
    $userNode->getElementsByTagName('email')->item(0)->nodeValue = $_REQUEST["email"];
    $message .= "email, ";
  }
  if (isset($_REQUEST["username"]) && !empty($_REQUEST["username"])) {
    $userNode->getElementsByTagName('username')->item(0)->nodeValue = $_REQUEST["username"];
    $message .= "username, ";
  }
  if (isset($_REQUEST["password"]) && !empty($_REQUEST["password"])) {
    $password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);
    $userNode->getElementsByTagName('password')->item(0)->nodeValue = $password;
    $message .= "password, ";
  }
  // Save the updated XML file
  $doc->save($xmlFilePath);

  $_SESSION["alert_message"] = $message . " updated successfully!";

  // Redirect to the account manager page after updating
  $id = $userNode->getAttribute("id");
  $email = $userNode->getElementsByTagName('email')->item(0)->nodeValue;
  $username = $userNode->getElementsByTagName('username')->item(0)->nodeValue;
  $url = "adminaccountedit.php?id=$id&email=$email&username=$username";
  $response = array(
    "status" => "success",
    "href" => $url,
  );
  header('Content-type: application/json');
  echo json_encode($response);
  exit;
} else {
  echo "User not found!";
}
