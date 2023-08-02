<?php
$userId = $_REQUEST['id'];

$xmlFilePath = "../xml/accounts.xml";

$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->load($xmlFilePath);

$users = $doc->getElementsByTagName("user");
foreach ($users as $user) {
  $id = $user->getAttribute("id");
  $username = $user->getElementsByTagName("username")->item(0)->nodeValue;
  if (strcmp($userId, $id) == 0) {
    $user->parentNode->removeChild($user);
    $doc->formatOutput = true;
    $doc->save($xmlFilePath); // Save the changes to the XML file
    returnRequest(200, $username . " deleted successfully. ");
  }
}

returnRequest(404, $userId . "User not found.");

function returnRequest($code, $message)
{
  $response = [
    "status" => $code,
    "message" => $message
  ];
  echo json_encode($response);
  exit;
}
