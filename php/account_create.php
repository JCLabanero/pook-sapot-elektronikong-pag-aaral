<?php
// Data validation and error reporting
$errors = [];
$errorMessage = "Validation failed";
$data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if (empty($data['username'])) {
  $errors[] = "username";
}
$error = validateUsername($data['username']);
if ($error) {
  $errors[] = $error;
}
if (empty($data['email'])) {
  $errors[] = "email";
}
$error = validateEmail($data['email']);
if ($error) {
  $errors[] = $error;
}
if (empty($data['password'])) {
  $errors[] = "password";
}
$error = validatePassword($data['password']);
if ($error) {
  $errorMessage = $error;
  $errors[] = ["password"];
}

// Return errors if any
if (!empty($errors)) {
  returnRequest(400, $errorMessage, $errors);
}

// Load the XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load('../xml/accounts.xml');

// Check if the username or email already exists
$existingUser = $xml->getElementsByTagName('user');
foreach ($existingUser as $user) {
  $existingUsername = $user->getElementsByTagName('username')->item(0)->nodeValue;
  $existingEmail = $user->getElementsByTagName('email')->item(0)->nodeValue;
  if (strcasecmp($existingEmail, $data['email']) === 0) {
    returnRequest(403, "Email already exists.", ['email']);
  }
  if (strcasecmp($existingUsername, $data['username']) === 0) {
    returnRequest(403, "Username already exists.", ['username']);
  }
}

// Create a new user element
$user = $xml->createElement('user');
$user->setAttribute('id', uniqid());

// Create username element and append it to the user element
$user->appendChild($xml->createElement('username', $data['username']));

// Create password element and append it to the user element
$user->appendChild($xml->createElement('password', password_hash($data['password'], PASSWORD_DEFAULT)));

// Create email element and append it to the user element
$user->appendChild($xml->createElement('email', $data['email']));

// Append the user element to the root element of the XML file
$root = $xml->documentElement;
$root->appendChild($user);

$xml->formatOutput = true;

// Save the modified XML file
$xml->save('../xml/accounts.xml');

// Return success response
returnRequest(200, "Registration success. You can now login.");

function returnRequest($code, $message, $errors = [])
{
  $response = [
    "status" => $code,
    "message" => $message,
    "errors" => $errors
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
