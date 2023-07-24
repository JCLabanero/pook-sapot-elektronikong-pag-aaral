<?php
session_start();

$data = array(
  "id" => $_REQUEST["id"],
  "username" => $_REQUEST["username"],
  "email" => $_REQUEST["email"],
  "password" => $_REQUEST["password"],
);

$updatedFields = [];
$errorFields = [];
$xmlFilePath = "../xml/accounts.xml";

// Create a DOMDocument instance and load the XML file
$doc = new DOMDocument();
$doc->load($xmlFilePath);
$doc->preserveWhiteSpace = false;

$users = $doc->getElementsByTagName("user");
//search for same
foreach ($users as $user) {
  $id = $user->getAttribute("id");
  if ($id == $data["id"])
    continue;
  $username = $user->getElementsByTagName("username")->item(0)->nodeValue;
  $email = $user->getElementsByTagName("email")->item(0)->nodeValue;
  if ($data["username"] == $username || $data["email"] == $email) {
    $message = null;
    if ($data["username"] == $username) {
      $message .= "Username, ";
      $errorFields[] = "username";
    }
    if ($data["email"] == $email) {
      $message .= "Email, ";
      $errorFields[] = "email";
    }
    returnRequest(400, "Field(s) already exist.", $updatedFields, $errorFields);
  }
}
//search for id
foreach ($users as $user) {
  $id = $user->getAttribute("id");
  $username = $user->getElementsByTagName("username")->item(0)->nodeValue;
  $email = $user->getElementsByTagName("email")->item(0)->nodeValue;
  $password = $user->getElementsByTagName("password")->item(0)->nodeValue;
  if ($id == $data["id"]) {
    if (!empty($data["username"])) {
      if ($data["username"] == $username) {
        $errorFields[] = "username";
      }
      $user->getElementsByTagName('username')->item(0)->nodeValue = $data["username"];
      $updatedFields[] = "username";
    }
    if (!empty($data["email"])) {
      if ($data["email"] == $email) {
        $errorFields[] = "email";
      }
      $user->getElementsByTagName('email')->item(0)->nodeValue = $data["email"];
      $updatedFields[] = "email";
    }
    if (!empty($data["password"])) {
      if (password_verify($data["password"], $password)) {
        $errorFields[] = "password";
      }
      $newPass = password_hash($data["password"], PASSWORD_DEFAULT);
      $user->getElementsByTagName('password')->item(0)->nodeValue = $newPass;
      $updatedFields[] = "password";
    }
    if (!empty($errorFields))
      returnRequest(202, "Field(s) are Identical.", [], $errorFields);
    if (!empty($updatedFields)) {
      $doc->formatOutput = true;
      $doc->save($xmlFilePath);
      returnRequest(200, "Updated Successfully", $updatedFields);
    }
    returnRequest(201, "Nothing has been updated.", $updatedFields);
  }
};
echo returnRequest(400, "error", $updatedFields);
function returnRequest($code, $message, $updatedFields, $errorFields = [])
{
  $response = [
    "status" => $code,
    "message" => $message,
    "updatedFields" => $updatedFields,
    "errorFields" => $errorFields,
  ];
  echo json_encode($response);
  exit;
}
