<?php 
require "../includes/in_start.php"
?>
<body class="container-fluid">
  <?php require_once("../includes/header.php");?>
    <main>
      <h2>User List</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
          <tbody>
            <?php
            // Include the account manager PHP file
            include('../php/account_manager.php');
            ?>
          </tbody>
        </table>
      </div>
    </main>
</body>
<?php include "../includes/in_end.php" ?>