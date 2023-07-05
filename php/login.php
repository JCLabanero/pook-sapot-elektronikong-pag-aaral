<?php
// Read the submitted form data
$usernameOrEmail = $_REQUEST["usernameOrEmail"];
$password = $_REQUEST["password"];

// Your code to validate the login credentials
// Example: Check if the username or email and password match an existing user in the XML
$existingUser = false;
$xml = simplexml_load_file("../xml/accounts.xml");
// Debug statements
foreach ($xml->user as $user) {
  $username = $user->username;
  $email = $user->email;
  $storedPassword = $user->password;
  $id = $user["id"];
    
  if (strcasecmp($usernameOrEmail, $username) === 0 || strcasecmp($usernameOrEmail, $email) === 0) {
    $existingUser = true;
    if (password_verify($password, $storedPassword)) {
      echo "success";
      exit;
    } else {
      echo "Incorrect password.";
      exit;
    }
  }
}

if (!$existingUser) {
  echo "User not found.";
  exit;
}
?>
