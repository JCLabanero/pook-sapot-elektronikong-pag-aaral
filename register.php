<?php include_once("includes/start_out.php"); ?>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="w-100 m-auto">
        <form id="registrationForm" name="registrationForm" method="post" class=" m-auto p-3 rounded" style="max-width: 350px;" novalidate>
            <h1 class="mb-3">Sign Up</h1>
            <div class="mb-3 form-floating">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
                    <i class="bi bi-check-circle"></i>
                    <i class="bi bi-exclamation-triangle"></i>
                    <p class="alert-message my-auto">You should check in on some of those fields below.</p><a href="login.php" class="alert-link" style="display: none;">click here</a>
                    <button type="button" class="btn-close" id="alert-close"></button>
                </div>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control rounded-0 rounded-top" id="email" placeholder="name@example.com">
                <label for="email" class="form-label">Email Address</label>
            </div>
            <div class="my-0 form-floating">
                <input type="text" class="form-control rounded-0" id="username" placeholder="name">
                <label for="username" class="form-label">Username</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="password" class="form-control rounded-0 rounded-bottom" id="password" placeholder="Password123+_">
                <label for="password" class="form-label">Password</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Log In?</label>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            </div>
            <div class="mb-3 text-center">
                <a href="login.php">Already have an account? Login</a>
            </div>
        </form>
    </main>
</body>
<?php include_once("includes/end_out.php"); ?>