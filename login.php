<?php include_once("includes/start_out.php"); ?>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="w-100 m-auto">
        <form id="loginForm" name="loginForm" method="post" class=" m-auto p-3 rounded" style="max-width: 350px;">
            <h1 class="mb-3">Sign In</h1>
            <div class="mb-3 form-floating">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
                    <p class="alert-message my-auto">You should check in on some of those fields below.</p>
                    <button type="button" class="btn-close" id="alert-close"></button>
                </div>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control rounded-0 rounded-top" id="user" name="user" placeholder="name@example.com">
                <label for="user" class="form-label">Username</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="password" class="form-control rounded-0 rounded-bottom" id="password" name="password" placeholder="Password123+_">
                <label for="password" class="form-label">Password</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <div class="mb-3">
                <button type="submit" id="signin" class="btn btn-primary w-100">Sign In</button>
            </div>
            <div class="mb-3 text-center">
                <a href="register.php">Doesn't have an account? Register</a>
            </div>
        </form>
    </main>
</body>
<?php include_once("includes/end_out.php"); ?>