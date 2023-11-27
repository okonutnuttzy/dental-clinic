<!DOCTYPE html>
<html lang="en">
<head>
<?php include "head.php"; ?>
</head>
<body>
  <div id="login-container" class="container">
    <div class="card shadow rounded-0 border-0">
      <div class="card-header border-0 text-center fs-4 h4"><strong>Dental Care</strong></div>
      <div class="card-body">
        <form action="functions.php" method="post" class="d-flex flex-column">
          <label for="usernameInput" class="text-center">Username:</label>
          <input type="text" name="username" id="usernameInput" class="form-control form-control-sm">
          <label for="passwordInput" class="text-center">Password:</label>
          <input type="password" name="password" id="passwordInput" class="form-control form-control-sm">
          <input type="submit" value="Sign in" name="loginBtn" class="btn btn-sm btn-info text-light mt-4">
        </form>
      </div>
    </div>
  </div>
  <?php
    if(isset($_GET['loginFailed'])) {
      echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Invalid</strong> Username/Password.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      ';
    }
  ?>
</body>
</html>