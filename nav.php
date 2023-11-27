<?php
echo '
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand h5 my-auto" href="#">Dental Care</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="appointment.php?refresh">Appointment</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Records</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="functions.php?signout" class="btn btn-sm btn-danger text-light text-decoration-none">Sign out</a>
      </span>
      </div>
  </div>
</nav>
';
?>