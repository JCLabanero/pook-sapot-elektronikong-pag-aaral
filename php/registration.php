<?php
// Get the username and password from the AJAX request
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$email = $_REQUEST['email'];

// Perform any necessary validation and sanitization of input data here

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
$usernameElement = $xml->createElement('username', $username);
$user->appendChild($usernameElement);

// Create password element and append it to the user element
$encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
$passwordElement = $xml->createElement('password', $encryptedPassword);
$user->appendChild($passwordElement);

// Create email element and append it to the user element
$emailElement = $xml->createElement('email', $email);
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
