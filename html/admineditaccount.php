<?php
include_once("../includes/in_start.php");
?>

<body class="container-fluid">
    <header>
        <?php
        if (isset($_SESSION["success_edit_message"])) {
            echo "<div class='alert alert-success text-center my-1 alert-dismissible fade show' role='alert'>";
            echo "<i class='bi bi-check-circle me-2 h5 align-middle'></i>";
            echo $_SESSION["success_edit_message"];
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
            unset($_SESSION["success_edit_message"]);
        }
        ?>
    </header>
    <?php include_once("../includes/header.php"); ?>
    <main>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h2><?php echo $_REQUEST["username"] ?></h2>
            <p class="lead"> Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
        </div>

        <div class="col-8 m-auto mb-3">
            <h4 class="mb-3">Information</h4>
            <form id="edit-account" action="../php/account_edit.php" method="POST" novalidate>
                <div class="row g-3">
                    <div class="col-12">
                        <!-- id -->
                        <input class="form-control" name="id" id="id" type="text" value="<?php echo $_REQUEST["id"] ?>" readonly>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <!-- username -->
                            <input type="text" name="username" class="form-control" id="username" placeholder="<?php echo $_REQUEST["username"] ?>">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
                        <!-- email -->
                        <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $_REQUEST["email"] ?>">
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" id="password" placeholder="****">
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