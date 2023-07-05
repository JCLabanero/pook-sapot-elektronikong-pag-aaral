<?php 
include_once("../includes/in_start.php");

if(isset($_REQUEST["id"]))
{
    $id = $_REQUEST["id"];
    // $_SESSION["toUdId"] = $id;
}
if(isset($_REQUEST["email"]))
{
    $email = $_REQUEST["email"];
    // $_SESSION["toUdEmail"] = $email;
}
if(isset($_REQUEST["username"]))
{
    $username = $_REQUEST["username"];
    // $_SESSION["toUdUser"] = $username;
}

?>
<body class="container-fluid">
    <?php include_once("../includes/header.php"); ?>
    <main>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h2><?php echo $_REQUEST["username"] ?></h2>
            <p class="lead"><b><?php echo $_REQUEST["id"]?></b> Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
        </div>

        <div class="col-8 m-auto mb-3">
            <h4 class="mb-3">Information</h4>
            <form id="edit-account" method="POST" novalidate>
                <div class="row g-3">
                    <div class="col-12">
<!-- id -->
                    <input class="form-control" id="id" type="text" value="<?php echo $_SESSION["toUdId"]; ?>" aria-label="readonly input example" readonly>
                    <!-- <input type="text" class="form-control" name="item-wear" id="id" value="" readonly> -->
                        <!-- <input type="text" name="id" id="id" value=""> -->
                    <label for="username" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
<!-- username -->
                            <input type="text" class="form-control" id="username" placeholder="<?php echo $_REQUEST["username"] ?>" required>
                        </div>
                    </div>

                    <div class="col-12">
                    <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
<!-- email -->
                    <input type="email" class="form-control" id="email" placeholder="<?php echo $_REQUEST["email"] ?>">
                    </div>

                    <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="****">
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