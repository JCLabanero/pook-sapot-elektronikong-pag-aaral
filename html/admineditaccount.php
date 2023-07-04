<?php 
include_once("../includes/in_start.php");

$id = $_REQUEST["id"];
$email = $_REQUEST["email"];
$username = $_REQUEST["username"];
?>
<body class="container-fluid">
    <?php include_once("../includes/header.php"); ?>
    <main>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h2><?php echo $username ?></h2>
            <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
        </div>

        <div class="col-8 m-auto mb-3">
            <h4 class="mb-3">Information</h4>
            <form class="edit-account" novalidate>
            <div class="row g-3">
                <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="username" placeholder="<?php echo $username ?>" required>
                </div>
                </div>

                <div class="col-12">
                <label for="email" class="form-label"><?php echo $email ?> <span class="text-body-secondary">(Optional)</span></label>
                <input type="email" class="form-control" id="email" placeholder="<?php echo $email ?>">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
                </div>

                <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" placeholder="****">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
                </div>
            </div>
            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Update Account</button>
            </form>
        </div>
    </main>
    <footer>

    </footer>
</body>
<?php include "../includes/in_end.php" ?>