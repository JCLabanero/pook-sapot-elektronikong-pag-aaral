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
$error = validateUsername($data['username']);
if (!empty($error)) {
  returnRequest(403, $error, ['username']);
}
$error = validateEmail($data['email']);
if (!empty($error)) {
  returnRequest(403, $error, ['email']);
}
$error = validatePassword($data['password']);
if (!empty($error)) {
  returnRequest(403, $error, ['password']);
}

// Load the XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load('../xml/accounts.xml'); // Replace 'accounts.xml' with the path to your XML file

// Check if the username or email already exists
$existingUser = $xml->getElementsByTagName('user');
foreach ($existingUser as $user) {
  $existingUsername = $user->getElementsByTagName('username')->item(0)->nodeValue;
  $existingEmail = $user->getElementsByTagName('email')->item(0)->nodeValue;
  if ($existingEmail === $data['email']) {
    returnRequest(403, "Email already exists", ['email']);
  }
  if ($existingUsername === $data['username']) {
    returnRequest(403, "Username already exists", ['email']);
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
echo returnRequest(200, "Registration success, to login ");

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

function validateUsername($username)
{
  $error = null;
  $minUsernameLength = 3; // Minimum length for username
  $maxUsernameLength = 20; // Maximum length for username
  // Regular expression to match alphanumeric characters, underscores, and hyphens
  $usernameRegex = '/^[a-zA-Z0-9_\-\s]+$/';
  if (strlen($username) < $minUsernameLength || strlen($username) > $maxUsernameLength) {
    $error = "Username length must be 3-20";
  }
  if (!preg_match($usernameRegex, $username)) {
    $error = "Special characters are limited";
  }
  return $error;
}
function validateEmail($email)
{
  $error = null;
  // Regular expression pattern for email validation
  $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
  // Use preg_match to perform the validation
  if (!preg_match($pattern, $email)) {
    $error = "Email is invalid"; // Email is invalid
  }
  return $error;
}
function validatePassword($password)
{
  $error = null;
  // Password length must be 8 or more characters
  if (strlen($password) < 8) {
    $error = "Password length must be 8 or more characters";
  }
  // Check if the password contains at least one uppercase letter
  if (!preg_match('/[A-Z]/', $password)) {
    $error = "Password must contain at least one uppercase letter";
  }
  // Check if the password contains at least one lowercase letter
  if (!preg_match('/[a-z]/', $password)) {
    $error = "Password must contain at least one lowercase letter";
  }
  // Check if the password contains at least one digit
  if (!preg_match('/\d/', $password)) {
    $error = "Password must contain at least one digit";
  }
  // Check if the password contains at least one special character
  if (!preg_match('/[^A-Za-z0-9]/', $password)) {
    $error = "Password must contain at least one special character";
  }
  return $error;
}
