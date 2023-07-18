<?php
require "../includes/start_in.php";
?>

<body class="container-fluid">
  <?php require_once("../includes/header.php"); ?>
  <main>
    <h2>User List</h2>
    <div class="table-responsive small">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Control</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Include the account manager PHP file
          include('../php/account_retrieve.php');
          foreach ($xml->user as $user) {
            $username = $user->username;
            $email = $user->email;
            $id = $user['id'];
            if ($_SESSION["id"] == $id)
              continue;
          ?>
            <tr>
              <td><?php echo $id ?></td>
              <td><?php echo $username ?></td>
              <td><?php echo $email ?></td>
              <td>
                <button data-id="<?php echo $id ?>" data-username="<?php echo $username ?>" data-email="<?php echo $email ?>" class="btn btn-success"><i class='bi bi-pencil-square'></i></button>
                <button data-id="<?php echo $id ?>" class="btn btn-danger"><i class='bi bi-trash'></i></button>
                <?php ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
<?php include "../includes/end_in.php" ?>