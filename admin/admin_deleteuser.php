<?php
  require_once('phpscripts/config.php');
  // confirm_logged_in();
  //
  $tbl = "tbl_user";
  $users = getAll($tbl);

 ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="https://fonts.googleapis.com/css?family=Bitter|Nanum+Gothic" rel="stylesheet">
<title>Delete User</title>
</head>
<body>
  <h1 class="hidden">Delete User</h1>
  <div class="container">
    <?php include('../includes/admin-nav.html'); ?>
    <div class="content">
      <h2>Delete Users</h2>

        <?php while($row = mysqli_fetch_array($users)) {
          echo "{$row['user_fname']}<a href=\"phpscripts/caller.php?caller_id=delete&id={$row['user_id']}\">Delete</a><br>";
        } ?>

    </div>

  </div>
</body>
</html>
