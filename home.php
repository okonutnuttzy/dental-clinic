<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "head.php"; ?>
</head>
<body>
  <?php 
    include "connection.php";
    include "nav.php";

    if(isset($_GET['registerSuccess'])) {
      echo "<script> alert('Registered'); </script>";
    }
  ?>
  <div class="container-fluid p-4">
    <!-- Summary / Dashboard -->
    <div class="row mb-3">
      <div class="col-lg shadow p-0">
        <strong>DASHBOARD HERE</strong>
      </div>
    </div>
  </div>
</body>
</html>