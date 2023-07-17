<?php
// Get the username and password from the AJAX request
$data = array(
  'username' => $_REQUEST['username'],
  'email' => $_REQUEST['email'],
  'password' => $_REQUEST['password']
);

$missingFields = [];

foreach ($data as $key => $value) {
  if (empty($value)) {
    $missingFields[] = $key;
  }
}
if (!empty($missingFields)) {
  returnRequest(400, "Fields are required.", $missingFields);
}
// Perform any necessary validation and sanitization of input data here
// if (empty($username) || empty($password) || empty($email)) {
//   if (empty($email) && empty($username)) echo returnRequest(404, "Password required");
//   if (empty($email) && empty($password)) echo returnRequest(405, "Username required");
//   if (empty($username) && empty($password)) echo returnRequest(406, "Email required");
//   if (empty($email)) echo returnRequest(401, "Username and password are required");
//   if (empty($username)) echo returnRequest(402, "Email and password are required.");
//   if (empty($password)) echo returnRequest(403, "Username and email are requried");
//   echo returnRequest(400, "Fields are required.");
// }
// Load the XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load('../xml/accounts.xml'); // Replace 'accounts.xml' with the path to your XML file

// Check if the username or email already exists
$existingUser = $xml->getElementsByTagName('user');
foreach ($existingUser as $user) {
  $existingUsername = $user->getElementsByTagName('username')->item(0)->nodeValue;
  $existingEmail = $user->getElementsByTagName('email')->item(0)->nodeValue;
  if ($existingEmail === $email) {
    echo "Email already exists";
    exit;
  }
  if ($existingUsername === $username) {
    echo "Username already exists";
    exit;
  }
}

// Create a new user element
$user = $xml->createElement('user');
$user->setAttribute('id', uniqid()); // Generate a unique ID for the user

// Create username element and append it to the user element
$usernameElement = $xml->createElement('username', $data['username']);
$user->appendChild($usernameElement);

// Create password element and append it to the user element
$encryptedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
$passwordElement = $xml->createElement('password', $encryptedPassword);
$user->appendChild($passwordElement);

// Create email element and append it to the user element
$emailElement = $xml->createElement('email', $data['email']);
$user->appendChild($emailElement);

// Append the user element to the root element of the XML file
$root = $xml->documentElement;
$root->appendChild($user);

$xml->formatOutput = true;
// Save the modified XML file
$xml->save('../xml/accounts.xml'); // Replace 'accounts.xml' with the path to your XML file
// $formattedXML = $xml->saveXML();
// file_put_contents('../xml/accounts.xml',$formattedXML);

// Return a response to the JavaScript code
echo "success";

function returnRequest($code, $message, $missingFields = [])
{
  $response = [
    "status" => $code,
    "message" => "$message",
    "missingFields" => $missingFields
  ];
  echo json_encode($response);
  exit;
}
