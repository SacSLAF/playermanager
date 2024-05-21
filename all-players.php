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

        





        </div>
        <!-- content-wrapper ends -->
        <?php include 'templates/footer.php'; ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


  <?php include 'templates/foot.php'; ?>
</body>

</html>

