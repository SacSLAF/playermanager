<?php

include 'config.php';
include 'templates/head.php';

// var_dump($_SESSION['username']);exit;

// Check if session username is not set
if (!isset($_SESSION['username'])) {
  // Redirect to the login page
  header("Location:../../index.php");
  exit();
}


?>
<body>
  <div class="container-scroller">
    <?php include 'templates/navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
    <?php
$role = $_SESSION['user_role'];
;
switch ($role) {
  case 'player':
    include 'templates/sidebar_player.php';
    break;
  case 'coach':
    include 'templates/sidebar_coach.php';
    break;
  case 'manager':
    include 'templates/sidebar_manager.php';
    break;
  default:
//code block
}


?>
      <div class="main-panel">
        <div class="content-wrapper">
          
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Setup your profile</h4>
                  <p class="card-description">
                    Complete your profile to reach more
                  </p>
                  <form class="forms-sample" method="post" action="process/complete-profile" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">First Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="First Name" name="firstname">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Last Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Last Name" name="lastname">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Date of birth</label>
                      <input type="date" class="form-control" id="exampleInputEmail3" placeholder="Date of birth" name="dateofbirth">
                    </div>
                    <!-- <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div> -->
                    <div class="form-group">
                      <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="exampleSelectGender" name="gender">
                        <option disabled selected>Select gender</option>
                          <option>Male</option>
                          <option>Female</option>
                          <option>Other</option>
                        </select>
                      </div>
                      <div class="form-group">
      <label>Profile picture</label>
      <input type="file" name="img" class="file-upload-default" id="profilePicture">
      <div class="input-group col-xs-12">
        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" id="fileUploadInfo">
        <span class="input-group-append">
          <button class="file-upload-browse btn btn-primary" type="button" id="uploadButton">Upload</button>
        </span>
      </div>
    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">City</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="City" name="city">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Country</label>
                      <input type="text" class="form-control" id="exampleInputCountry1" placeholder="Country" name="country">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Contact number</label>
                      <input type="tel" class="form-control" id="exampleContact" placeholder="Contact number" name="phone">
                    </div>
                    <!-- <div class="form-group">
                      <label for="exampleTextarea1">Textarea</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div> -->
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
        





        </div>
        <!-- content-wrapper ends -->
        <?php include 'templates/footer.php'; ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



  <script>
  document.getElementById('uploadButton').addEventListener('click', function() {
    document.getElementById('profilePicture').click();
  });

  document.getElementById('profilePicture').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('fileUploadInfo').value = fileName;
  });
</script>
  <?php include 'templates/foot.php'; ?>
</body>

</html>

