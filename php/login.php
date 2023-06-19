<?php
// Read the submitted form data
$usernameOrEmail = $_REQUEST["usernameOrEmail"];
$password = $_REQUEST["password"];

// Your code to validate the login credentials
// Example: Check if the username or email and password match an existing user in the XML

// Assuming you have already implemented the XML reading logic to check for existing users
// Here's a simplified example
$existingUser = false;
$xml = simplexml_load_file("../xml/accounts.xml");
// Debug statements
foreach ($xml->user as $user) {
  $username = $user->username;
  $email = $user->email;
  $storedPassword = $user->password;
    
  if (strcasecmp($usernameOrEmail, $username) === 0 || strcasecmp($password, $storedPassword) === 0) {
    $existingUser = true;
    if (password_verify($password, $storedPassword)) {
      // Login successful
      echo "success";
      exit;
    } else {
      // Incorrect password
      echo "Incorrect password.";
      exit;
    }
  }
}

if (!$existingUser) {
  // User not found
  echo "User not found.";
  exit;
}
?>
