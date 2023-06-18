<?php
// Read the submitted form data
$usernameOrEmail = $_GET["usernameOrEmail"];
$password = $_GET["password"];

// Your code to validate the login credentials
// Example: Check if the username or email and password match an existing user in the XML

// Assuming you have already implemented the XML reading logic to check for existing users
// Here's a simplified example
// $existingUser = false;
$xml = simplexml_load_file("../xml/accounts.xml");
// Debug statements
echo "Received username or email: " . $usernameOrEmail . "<br>";
echo "Received password: " . $password . "<br>";
foreach ($xml->user as $user) {
  $username = $user->username;
  $email = $user->email;
  $storedPassword = $user->password;
  echo $username. "||" .$email;

    // if (strcasecmp($usernameOrEmail, $username) === 0 || strcasecmp($usernameOrEmail, $email) === 0) {
    //     echo "true";
    // } else {
    //     echo "false";
    // }

    if (strtolower(trim($usernameOrEmail)) == strtolower(trim($username)) || strtolower(trim($usernameOrEmail)) == strtolower(trim($email))) {
        echo "true";
    } else {
        echo "false";
    }
    

  if ($usernameOrEmail === $username || $usernameOrEmail === $email) {
    $existingUser = true;
    if ($password === $storedPassword) {
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

// if (!$existingUser) {
//   // User not found
//   echo "User not found.";
//   exit;
// }
?>
