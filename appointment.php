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
    <!-- Search, Add Patient -->
    <div class="row mb-3">
      <div class="card col-lg shadow p-0">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10 d-flex text-end mb-2">
              <a href="home.php?refresh" class="btn btn-sm btn-info text-light me-5 d-flex">
                <p class="my-auto">Refresh</p>  
              </a>
              <div class="input-group">
                <form action="home.php" method="get" class="input-group" id="searchForm"></form>
                <input type="text" name="searchInput" class="form-control form-control-sm" form="searchForm" placeholder="<?php if(isset($_GET['searchInput'])) { echo $_GET['searchInput']; }?>">
                <button type="submit" class="btn btn-sm btn-info text-light" name="searchBtn" form="searchForm">Search</button>
              </div>
            </div>
            <div class="col-lg-2 text-end mb-2">
              <button type="button" class="btn btn-sm btn-info text-light w-100" data-bs-toggle="modal" data-bs-target="#addPateintModal">
                Add Patient
              </button>
              <!-- Add Patient Modal -->
              <div class="modal fade" id="addPateintModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="functions.php" method="post">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 my-auto" id="patientModalLabel">Add Patient</h1>
                        <button type="button" class="btn-close my-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-lg text-start">
                            <label for="firstNameInput">First Name</label>
                            <input required type="text" name="firstName" id="firstNameInput" class="form-control form-control-sm">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg text-start">
                            <label for="lastNameInput">Last Name</label>
                            <input required type="text" name="lastName" id="lastNameInput" class="form-control form-control-sm">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg text-start">
                            <label for="emailInput">Email</label>
                            <input required type="email" name="email" id="emailInput" class="form-control form-control-sm">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg text-start">
                            <label for="contactInput">Contact #</label>
                            <input required type="number" name="contact" id="contactInput" class="form-control form-control-sm">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg text-start">
                            <label for="genderInput">Gender</label>
                            <select required name="gender" id="genderInput" class="form-select form-select-sm">
                              <option value="1" selected>Male</option>
                              <option value="2">Female</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" name="resetBtn" class="btn btn-sm my-auto btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="registerBtn" class="btn btn-sm my-auto btn-info text-light">Register</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body py-0 px-1">
          <table class="table table-striped">
            <thead>
              <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Contact</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Search Filter -->
              <?php
                if(isset($_GET['searchBtn'])) {
                  $filter = $_GET['searchInput'];
                  $sql = "SELECT * FROM tbl_patients WHERE CONCAT(firstname, lastname) LIKE '%$filter%' ";
                  $res = mysqli_query($con, $sql) or die (mysqli_error($con));
                  if(mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_object($res)) {
                    ?>
                      <tr>
                        <th scope="row"><?= $row->PatientID; ?></th>
                        <td><?= $row->FirstName; ?></td>
                        <td><?= $row->LastName; ?></td>
                        <td><?= $row->ContactNumber; ?></td>
                        <td>
                          <button type="button" name="setAppointment" class="btn btn-sm btn-info text-light" data-bs-toggle="modal" data-bs-target="#appointmentModal<?= $row->PatientID; ?>">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                              <path d="M10.3009 13.6949L20.102 3.89742M10.5795 14.1355L12.8019 18.5804C13.339 19.6545 13.6075 20.1916 13.9458 20.3356C14.2394 20.4606 14.575 20.4379 14.8492 20.2747C15.1651 20.0866 15.3591 19.5183 15.7472 18.3818L19.9463 6.08434C20.2845 5.09409 20.4535 4.59896 20.3378 4.27142C20.2371 3.98648 20.013 3.76234 19.7281 3.66167C19.4005 3.54595 18.9054 3.71502 17.9151 4.05315L5.61763 8.2523C4.48114 8.64037 3.91289 8.83441 3.72478 9.15032C3.56153 9.42447 3.53891 9.76007 3.66389 10.0536C3.80791 10.3919 4.34498 10.6605 5.41912 11.1975L9.86397 13.42C10.041 13.5085 10.1295 13.5527 10.2061 13.6118C10.2742 13.6643 10.3352 13.7253 10.3876 13.7933C10.4468 13.87 10.491 13.9585 10.5795 14.1355Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                          </button>
                          <!-- Appointment Modal -->
                          <div class="modal fade" id="appointmentModal<?= $row->PatientID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <form action="functions.php" method="get">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="appointmentModal">Appointment</h1>
                                    Assistant : <?= $_SESSION['AssistantFullName'] ?>
                                  </div>
                                  <div class="modal-body">
                                    <div>
                                      <div class="row mb-2">
                                        <?php
                                          if(isset($_GET['setAppointment'])) {
                                            $sql = "SELECT * FROM tbl_dentist";
                                            $res = mysqli_query($con, $sql) or die (mysqli_error($con));
                                            while($row = mysqli_fetch_object($res)) {
                                              ?>
                                              <p class="text-center my-auto">Dentist : <?= $row->DentistName ?></p>
                                              <?php
                                            }
                                          }
                                        ?>
                                        <p class="text-center my-auto">Patient : <?= $row->LastName ?>, <?= $row->FirstName ?></p>
                                      </div>
                                    
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Last Name : </p></div>
                                        <div class="col-lg"><input type="text" name="lastName" id="lastNameInput" class="form-control form-control-sm"></div>
                                      </div>
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Email : </p></div>
                                        <div class="col-lg"><input type="email" name="email" id="emailInput" class="form-control form-control-sm"></div>
                                      </div>
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Contact Number : </p></div>
                                        <div class="col-lg"><input type="number" name="contact" id="contactInput" class="form-control form-control-sm"></div>
                                      </div>
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Gender : </p></div>
                                        <div class="col-lg">
                                          <select name="gender" id="genderSelect" class="form-select form-select-sm">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-info text-light">Set Appointment</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                      <tr>
                        <td colspan="5">No Record Found</td>
                      </tr>
                    <?php
                  }
                }
              ?>
              <!-- All Records -->
              <?php
                if(isset($_GET['refresh'])) {
                  $sql = "SELECT * FROM tbl_patients";
                  $res = mysqli_query($con, $sql) or die (mysqli_error($con));
                  if(mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_object($res)) {
                    ?>
                      <tr class="text-center">
                        <th scope="row"><?= $row->PatientID; ?></th>
                        <td><?= $row->FirstName; ?></td>
                        <td><?= $row->LastName; ?></td>
                        <td><?= $row->Email; ?></td>
                        <td><?= $row->ContactNumber; ?></td>
                        <td>
                          <input type="hidden" name="patientId" value="<?= $row->PatientID; ?>">
                          <button type="button" name="setAppointment" class="btn btn-sm btn-info text-light" data-bs-toggle="modal" data-bs-target="#appointmentModal<?= $row->PatientID; ?>">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                              <path d="M10.3009 13.6949L20.102 3.89742M10.5795 14.1355L12.8019 18.5804C13.339 19.6545 13.6075 20.1916 13.9458 20.3356C14.2394 20.4606 14.575 20.4379 14.8492 20.2747C15.1651 20.0866 15.3591 19.5183 15.7472 18.3818L19.9463 6.08434C20.2845 5.09409 20.4535 4.59896 20.3378 4.27142C20.2371 3.98648 20.013 3.76234 19.7281 3.66167C19.4005 3.54595 18.9054 3.71502 17.9151 4.05315L5.61763 8.2523C4.48114 8.64037 3.91289 8.83441 3.72478 9.15032C3.56153 9.42447 3.53891 9.76007 3.66389 10.0536C3.80791 10.3919 4.34498 10.6605 5.41912 11.1975L9.86397 13.42C10.041 13.5085 10.1295 13.5527 10.2061 13.6118C10.2742 13.6643 10.3352 13.7253 10.3876 13.7933C10.4468 13.87 10.491 13.9585 10.5795 14.1355Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                          </button>
                          <!-- Appointment Modal -->
                          <div class="modal fade" id="appointmentModal<?= $row->PatientID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <form action="functions.php" method="get">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="appointmentModal">Appointment</h1>
                                    Assistant : <?= $_SESSION['AssistantFullName'] ?>
                                  </div>
                                  <div class="modal-body">
                                    <div class="container">
                                      <div class="row mb-2">
                                        <div class="col">
                                          <p class="text-center my-auto">Patient : <?= $row->LastName ?>, <?= $row->FirstName ?></p>
                                        </div>
                                      </div>
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Last Name : </p></div>
                                        <div class="col-lg"><input type="text" name="lastName" id="lastNameInput" class="form-control form-control-sm"></div>
                                      </div>
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Email : </p></div>
                                        <div class="col-lg"><input type="email" name="email" id="emailInput" class="form-control form-control-sm"></div>
                                      </div>
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Contact Number : </p></div>
                                        <div class="col-lg"><input type="number" name="contact" id="contactInput" class="form-control form-control-sm"></div>
                                      </div>
                                      <div class="row mb-2">
                                        <div class="col-lg"><p class="my-auto text-center">Gender : </p></div>
                                        <div class="col-lg">
                                          <select name="gender" id="genderSelect" class="form-select form-select-sm">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-info text-light">Set Appointment</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php
                    }
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>