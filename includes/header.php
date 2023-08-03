<header>
  <div class="my-2 mx-1 alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
    <p class="alert-message my-auto">You should check in on some of those fields below.</p>
    <button type="button" class="btn-close" id="alert-close"></button>
  </div>
  <div class='d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start mb-3'>
    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
        <use xlink:href="#bootstrap"></use>
      </svg>
    </a>

    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
      <li><a href="adminmenu.php" class="nav-link px-2 link-secondary">Home</a></li>
      <li><a href="adminlesson.php" class="nav-link px-2 link-body-emphasis">Lesson</a></li>
      <li><a href="adminquiz.php" class="nav-link px-2 link-body-emphasis">Quizzes</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li>
    </ul>

    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
      <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
    </form>

    <div class="dropdown text-end">
      <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
      </a>
      <ul class="dropdown-menu text-small">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="adminprofile.php">Profile</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="../php/session_delete.php">Sign out</a></li>
      </ul>
    </div>
  </div>
</header>