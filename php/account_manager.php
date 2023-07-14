<?php
// Read the account data from the XML file
$xml = simplexml_load_file("../xml/accounts.xml");

// Display the account data in a table
foreach ($xml->user as $user) {
  $username = $user->username;
  $email = $user->email;
  $id = $user['id'];
  if ($_SESSION["id"] == $id)
    continue;

  echo "<tr>";
  echo "<td>$id</td>";
  echo "<td>$username</td>";
  echo "<td>$email</td>";
  // href='adminaccountedit.php?id=$id&username=$username&email=$email'
  echo "<td><button data-id='$id' data-username='$username' data-email='$email' class='btn btn-success'><i class='bi bi-pencil-square'></i></button></td>";
  echo "<td><a href='../php/account_delete.php?id=$id' class='btn btn-danger'><i class='bi bi-trash'></i></a></td>";
  echo "</tr>";
}
