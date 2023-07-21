<?php
session_start();
// $userId = $_REQUEST["id"];
// $userUsername = ($_REQUEST["username"] != "") ? $_REQUEST["username"] : null;
// $userEmail = ($_REQUEST["email"] != "") ? $_REQUEST["email"] : null;
// $userPassword = ($_REQUEST["password"] != "") ? $_REQUEST["password"] : null;

$data = array(
  "id" => $_REQUEST["id"],
  "username" => $_REQUEST["username"],
  "email" => $_REQUEST["email"],
  "password" => $_REQUEST["password"],
);


$updatedFields = [];
$xmlFilePath = "../xml/accounts.xml";

// Create a DOMDocument instance and load the XML file
$doc = new DOMDocument();
$doc->load($xmlFilePath);


$users = $doc->getElementsByTagName("user");
//search for id
foreach ($users as $user) {
  $id = $user->getAttribute("id");
  $username = $user->getElementsByTagName("username")->item(0)->nodeValue;
  $email = $user->getElementsByTagName("email")->item(0)->nodeValue;
  $passwordEncrypt = $user->getElementsByTagName("password")->item(0)->nodeValue;
  if ($id == $data["id"]) {
    if (!empty($data["username"])) {
      $user->getElementsByTagName('username')->item(0)->nodeValue = $data["username"];
      $updatedFields[] = "username";
    }
    if (!empty($data["email"])) {
      $user->getElementsByTagName('email')->item(0)->nodeValue = $data["email"];
      $updatedFields[] = "email";
    }
    if (!empty($data["password"])) {
      $user->getElementsByTagName('email')->item(0)->nodeValue = $data["email"];
      $updatedFields[] = "password";
    }
    if (!empty($updatedFields))
      returnRequest(200, "Successful", $updatedFields);
    returnRequest(200, "Nothing has been updated");
};
echo returnRequest(400, "error", $updatedFields);
function returnRequest($code, $message, $updatedFields = [])
{
  $response = [
    "status" => $code,
    "message" => $message,
    "updatedFields" => $updatedFields,
  ];
  echo json_encode($response);
  exit;
}
