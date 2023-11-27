<?php
session_start();
include "connection.php";

if(isset($_POST['loginBtn'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM tbl_assistant WHERE username = '$username' AND password = '$password'; ";
  $res = mysqli_query($con, $sql) or die (mysqli_error($conn));

  $row = mysqli_fetch_assoc($res);
  if($row) {
    $_SESSION['AssistantID'] = $row['AssistantID'];
    $_SESSION['AssistantFullName'] = $row['FirstName']. ' ' .$row['LastName'];
    header("Location: home.php?refresh");
  } else {
    header("Location: index.php?loginFailed");
  }
}

if(isset($_GET['signout'])) {
  session_destroy();
  header("Location: index.php");
}

if(isset($_POST['registerBtn'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $gender = $_POST['gender'];

  $sql = "INSERT INTO tbl_patients (FirstName, LastName, Email, ContactNumber, Gender)
          VALUES ('$firstName', '$lastName', '$email', '$contact', $gender)
          ";
  $res = mysqli_query($con, $sql) or die (mysqli_error($con));
  if($res) {
    header('Location: home.php?registerSuccess&refresh');
  }
}
?>